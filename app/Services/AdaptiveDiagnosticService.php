<?php

namespace App\Services;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticResponse;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticProfile;
use Illuminate\Support\Facades\Log;

/**
 * Adaptive Diagnostic Service
 * 
 * Manages adaptive assessment logic including:
 * - Bloom level progression based on performance percentages
 * - Domain-specific question selection
 * - Performance tracking and analysis
 * 
 * State structure:
 * {
 *   "domain_bloom_levels": { "1": 3, "2": 4 },
 *   "domain_streaks": { "1": {"correct": 2, "incorrect": 0} },
 *   "domain_history": { "1": [true, false, true] },
 *   "domain_bloom_history": { "1": [3, 3, 3] },
 *   "domain_questions_at_level": { "1": { "3": 3 } }
 * }
 */
class AdaptiveDiagnosticService
{
    // Bloom progression thresholds based on cognitive complexity
    const BLOOM_ADVANCE_THRESHOLDS = [
        1 => 0.75,    // L1→L2: Need 75% (3/4)
        2 => 0.75,    // L2→L3: Need 75% (3/4)
        3 => 0.6667,  // L3→L4: Need 66.67% (2/3)
        4 => 0.6667,  // L4→L5: Need 66.67% (2/3)
        5 => 1.00,    // At L5: Need 100% to maintain
    ];
    
    const BLOOM_REGRESS_THRESHOLDS = [
        1 => 0.00,    // Can't go below L1
        2 => 0.25,    // L2→L1: Below 25% (1/4)
        3 => 0.34,    // L3→L2: Below 34% (1/3)
        4 => 0.40,    // L4→L3: Below 40% (2/5)
        5 => 0.50,    // L5→L4: Below 50% (1/2)
    ];
    
    const BLOOM_MIN_QUESTIONS = [
        1 => 2,  // Minimum 2 questions at level 1 (allows early advancement)
        2 => 2,  // Minimum 2 questions at level 2 (allows early advancement)
        3 => 2,  // Minimum 2 questions at level 3 (allows early advancement)
        4 => 2,  // Minimum 2 questions at level 4 (allows early advancement)
        5 => 2,  // Minimum 2 questions at level 5 (3rd only if 50% performance)
        6 => 2,  // Minimum 2 questions at level 6
    ];
    
    const MIN_QUESTIONS_PER_DOMAIN = 4; // Minimum to ensure basic coverage
    const QUESTIONS_PER_LEVEL = 2; // Minimum questions at each bloom level before decision
    const MAX_QUESTIONS_PER_DOMAIN = 12;

    /**
     * Initialize minimal test state
     */
    public function initializeTest(array $config = []): array
    {
        return [
            'domain_bloom_levels' => [],  // Will be set when domain is first encountered
            'domain_streaks' => [],       // Track consecutive correct/incorrect per domain
            'bloom_stability_counter' => 0, // Track questions without bloom changes
            'last_bloom_levels' => [],     // Track previous bloom levels for stability
            'domain_attempt_questions' => [] // Track questions per attempt at each level
        ];
    }

    /**
     * Process an answer and update state
     */
    public function processAnswer(array $state, DiagnosticItem $item, bool $isCorrect, ?int $userId = null): array
    {
        $domainId = $item->topic->domain_id;
        
        // Initialize domain if first time
        if (!isset($state['domain_bloom_levels'][$domainId])) {
            // Check for warm-start level
            $warmStartLevel = null;
            if ($userId) {
                $warmStartLevel = $this->getWarmStartLevel($userId, $domainId);
            }
            
            $startingLevel = $warmStartLevel ?? 3; // Default to L3 (Apply) if no warm-start
            
            $state['domain_bloom_levels'][$domainId] = $startingLevel;
            $state['domain_streaks'][$domainId] = ['correct' => 0, 'incorrect' => 0];
            $state['domain_history'][$domainId] = []; // Track answer history
            $state['domain_bloom_history'][$domainId] = []; // Track bloom level for each question
            $state['domain_questions_at_level'][$domainId] = [$startingLevel => 0]; // Track questions per level
            $state['domain_attempt_questions'][$domainId] = [$startingLevel => 0]; // Track current attempt
            
            if ($warmStartLevel) {
                Log::info('Domain initialized with warm-start', [
                    'domain_id' => $domainId,
                    'warm_start_level' => $warmStartLevel
                ]);
            }
        }
        
        // Track answer history
        $state['domain_history'][$domainId][] = $isCorrect;
        
        // Track the ACTUAL bloom level of the question answered (not the adaptive state level)
        $questionBloomLevel = $item->bloom_level;
        $state['domain_bloom_history'][$domainId][] = $questionBloomLevel;
        
        // Track questions at the ACTUAL question bloom level
        if (!isset($state['domain_questions_at_level'][$domainId][$questionBloomLevel])) {
            $state['domain_questions_at_level'][$domainId][$questionBloomLevel] = 0;
        }
        $state['domain_questions_at_level'][$domainId][$questionBloomLevel]++;
        
        // Get current adaptive bloom level (this is what we're trying to assess)
        $currentBloom = $state['domain_bloom_levels'][$domainId];
        
        // Track questions answered at current attempt
        if (!isset($state['domain_attempt_questions'][$domainId])) {
            $state['domain_attempt_questions'][$domainId] = [];
        }
        if (!isset($state['domain_attempt_questions'][$domainId][$currentBloom])) {
            $state['domain_attempt_questions'][$domainId][$currentBloom] = 0;
        }
        $state['domain_attempt_questions'][$domainId][$currentBloom]++;
        
        // Track questions answered while domain is at L5 (for ceiling test)
        if ($currentBloom === 5) {
            if (!isset($state['domain_questions_at_l5_level'])) {
                $state['domain_questions_at_l5_level'] = [];
            }
            if (!isset($state['domain_questions_at_l5_level'][$domainId])) {
                $state['domain_questions_at_l5_level'][$domainId] = 0;
            }
            $state['domain_questions_at_l5_level'][$domainId]++;
        }
        
        // Update streaks
        if ($isCorrect) {
            $state['domain_streaks'][$domainId]['correct']++;
            $state['domain_streaks'][$domainId]['incorrect'] = 0;
        } else {
            $state['domain_streaks'][$domainId]['incorrect']++;
            $state['domain_streaks'][$domainId]['correct'] = 0;
        }
        
        // Get minimum questions required at this level
        $minQuestionsAtLevel = self::BLOOM_MIN_QUESTIONS[$currentBloom] ?? 3;
        
        // Check if we have enough questions at the current adaptive level attempt to make a decision
        // Use attempt questions which tracks all questions answered while at this adaptive level
        $questionsAtCurrentAttempt = $state['domain_attempt_questions'][$domainId][$currentBloom] ?? 0;
        
        if ($questionsAtCurrentAttempt >= $minQuestionsAtLevel) {
            // Calculate performance across all questions answered during this adaptive level
            // This includes questions at any bloom level that were answered while domain was at currentBloom
            $correctAtLevel = 0;
            $totalAtLevel = 0;
            
            // Get the starting index for this attempt
            $totalPreviousQuestions = count($state['domain_history'][$domainId]) - $questionsAtCurrentAttempt;
            
            // Count performance for questions during this attempt at current adaptive level
            for ($i = $totalPreviousQuestions; $i < count($state['domain_history'][$domainId]); $i++) {
                if (isset($state['domain_history'][$domainId][$i])) {
                    $totalAtLevel++;
                    if ($state['domain_history'][$domainId][$i]) {
                        $correctAtLevel++;
                    }
                }
            }
            
            // Calculate accuracy percentage
            $accuracy = $totalAtLevel > 0 ? $correctAtLevel / $totalAtLevel : 0;
            
            // Early advancement rule: 2/2 = 100% at L1-L4 triggers immediate advancement
            // CRITICAL: Must be exactly 2 questions in current attempt, not total historical
            $isEarlyAdvancement = ($questionsAtCurrentAttempt == 2 && $totalAtLevel == 2 && $accuracy == 1.0 && $currentBloom < 5);
            
            // Check for advancement (must have correct threshold AND haven't reached max)
            // Statistical confidence requires 2+ questions minimum for ALL decisions
            if ($currentBloom < 5 && 
                $questionsAtCurrentAttempt >= 2 && 
                ($isEarlyAdvancement || $accuracy >= self::BLOOM_ADVANCE_THRESHOLDS[$currentBloom])) {
                $state['domain_bloom_levels'][$domainId] = $currentBloom + 1;
                
                // Initialize question count for new level
                if (!isset($state['domain_questions_at_level'][$domainId][$currentBloom + 1])) {
                    $state['domain_questions_at_level'][$domainId][$currentBloom + 1] = 0;
                }
                
                // Reset attempt counter for new level
                if (!isset($state['domain_attempt_questions'][$domainId])) {
                    $state['domain_attempt_questions'][$domainId] = [];
                }
                // CRITICAL: Always reset to 0, even if returning to a previously visited level
                // This ensures we need 2+ questions at this level in the new attempt
                $state['domain_attempt_questions'][$domainId][$currentBloom + 1] = 0;
                
                // Clear any previous attempt counter at the level we're leaving
                if (isset($state['domain_attempt_questions'][$domainId][$currentBloom])) {
                    unset($state['domain_attempt_questions'][$domainId][$currentBloom]);
                }
                
                // Track when domain first reaches L5 for ceiling test
                if ($currentBloom + 1 === 5) {
                    if (!isset($state['domain_questions_at_l5_level'])) {
                        $state['domain_questions_at_l5_level'] = [];
                    }
                    $state['domain_questions_at_l5_level'][$domainId] = 0;
                }
                
                Log::info('Bloom level increased', [
                    'domain_id' => $domainId,
                    'old_level' => $currentBloom,
                    'new_level' => $currentBloom + 1,
                    'accuracy' => round($accuracy * 100, 2) . '%',
                    'threshold' => round(self::BLOOM_ADVANCE_THRESHOLDS[$currentBloom] * 100, 2) . '%',
                    'early_advancement' => $isEarlyAdvancement
                ]);
            }
            // Check for regression (accuracy below threshold AND haven't reached min level)
            // Statistical confidence requires 2+ questions minimum for ALL decisions
            elseif ($currentBloom > 1 && 
                    $questionsAtCurrentAttempt >= 2 &&
                    $accuracy < self::BLOOM_REGRESS_THRESHOLDS[$currentBloom]) {
                Log::info('Regression check triggered', [
                    'domain_id' => $domainId,
                    'current_bloom' => $currentBloom,
                    'questions_at_attempt' => $questionsAtCurrentAttempt,
                    'accuracy' => round($accuracy * 100, 2) . '%',
                    'threshold' => round(self::BLOOM_REGRESS_THRESHOLDS[$currentBloom] * 100, 2) . '%'
                ]);
                // Check if previous level was already proven with high confidence
                $previousLevel = $currentBloom - 1;
                $previousLevelProven = false;
                
                // Special case: Always allow regression from L5
                // L5 requires consistent expert performance; failing means L4+ ceiling
                if ($currentBloom !== 5 && isset($state['domain_questions_at_level'][$domainId][$previousLevel])) {
                    // Count performance at previous level
                    $correctAtPrevious = 0;
                    $totalAtPrevious = 0;
                    
                    foreach ($state['domain_bloom_history'][$domainId] as $index => $level) {
                        if ($level === $previousLevel && isset($state['domain_history'][$domainId][$index])) {
                            $totalAtPrevious++;
                            if ($state['domain_history'][$domainId][$index]) {
                                $correctAtPrevious++;
                            }
                        }
                    }
                    
                    // If previous level was proven with >= 75% accuracy, don't regress
                    if ($totalAtPrevious >= 2 && ($correctAtPrevious / $totalAtPrevious) >= 0.75) {
                        $previousLevelProven = true;
                    }
                }
                
                if ($previousLevelProven) {
                    // Don't regress - previous level was already proven
                    // Mark domain as complete at previous level
                    Log::info('Regression prevented - previous level already proven', [
                        'domain_id' => $domainId,
                        'current_level' => $currentBloom,
                        'proven_level' => $previousLevel,
                        'current_accuracy' => round($accuracy * 100, 2) . '%'
                    ]);
                    
                    // Set a flag to indicate this domain found its ceiling
                    if (!isset($state['domain_ceiling_found'])) {
                        $state['domain_ceiling_found'] = [];
                    }
                    $state['domain_ceiling_found'][$domainId] = $previousLevel;
                } else {
                    // Normal regression
                    $state['domain_bloom_levels'][$domainId] = $currentBloom - 1;
                    
                    // Initialize question count for new level if needed
                    if (!isset($state['domain_questions_at_level'][$domainId][$currentBloom - 1])) {
                        $state['domain_questions_at_level'][$domainId][$currentBloom - 1] = 0;
                    }
                    
                    // Reset attempt counter when returning to a level
                    if (!isset($state['domain_attempt_questions'][$domainId])) {
                        $state['domain_attempt_questions'][$domainId] = [];
                    }
                    $state['domain_attempt_questions'][$domainId][$currentBloom - 1] = 0;
                    
                    // CRITICAL: Clear the attempt counter for the level we're leaving
                    // This prevents counting old attempts when returning to this level
                    if (isset($state['domain_attempt_questions'][$domainId][$currentBloom])) {
                        unset($state['domain_attempt_questions'][$domainId][$currentBloom]);
                    }
                    
                    Log::info('Bloom level decreased', [
                        'domain_id' => $domainId,
                        'old_level' => $currentBloom,
                        'new_level' => $currentBloom - 1,
                        'accuracy' => round($accuracy * 100, 2) . '%',
                        'threshold' => round(self::BLOOM_REGRESS_THRESHOLDS[$currentBloom] * 100, 2) . '%',
                        'attempt_reset' => true
                    ]);
                }
            }
        }
        
        // Log regression check conditions
        if ($currentBloom > 1 && $questionsAtCurrentAttempt >= 2) {
            Log::info('Regression check conditions', [
                'domain_id' => $domainId,
                'current_bloom' => $currentBloom,
                'questions_at_attempt' => $questionsAtCurrentAttempt,
                'accuracy' => round($accuracy * 100, 2) . '%',
                'regress_threshold' => round(self::BLOOM_REGRESS_THRESHOLDS[$currentBloom] * 100, 2) . '%',
                'needs_regression' => $accuracy < self::BLOOM_REGRESS_THRESHOLDS[$currentBloom]
            ]);
        }
        
        // Track bloom stability - check if ANY domain changed
        $bloomChanged = false;
        $lastBloomLevels = $state['last_bloom_levels'] ?? [];
        
        // Check each domain for changes
        foreach ($state['domain_bloom_levels'] as $domId => $level) {
            if (!isset($lastBloomLevels[$domId]) || $lastBloomLevels[$domId] !== $level) {
                $bloomChanged = true;
                break;
            }
        }
        
        // Also check if new domains were added
        if (count($state['domain_bloom_levels']) !== count($lastBloomLevels)) {
            $bloomChanged = true;
        }
        
        if (!$bloomChanged && !empty($lastBloomLevels)) {
            $state['bloom_stability_counter'] = ($state['bloom_stability_counter'] ?? 0) + 1;
        } else {
            $state['bloom_stability_counter'] = 0;
        }
        
        $state['last_bloom_levels'] = $state['domain_bloom_levels'];
        
        return $state;
    }

    /**
     * Get current bloom level for a domain
     */
    public function getDomainBloomLevel(array $state, int $domainId): int
    {
        return $state['domain_bloom_levels'][$domainId] ?? 3; // Default to Apply
    }

    /**
     * Check if domain assessment should continue
     */
    public function shouldContinueDomain(int $domainId, int $questionsInDomain, array $state): bool
    {
        // Always respect minimum questions per domain
        if ($questionsInDomain < self::MIN_QUESTIONS_PER_DOMAIN) {
            return true;
        }
        
        // Hard stop at max questions (but this is high)
        if ($questionsInDomain >= self::MAX_QUESTIONS_PER_DOMAIN) {
            return false;
        }
        
        // Stop if ceiling was found (proven level + failed at next level)
        if (isset($state['domain_ceiling_found'][$domainId])) {
            Log::info('Domain testing complete - ceiling found', [
                'domain_id' => $domainId,
                'proven_level' => $state['domain_ceiling_found'][$domainId]
            ]);
            return false;
        }
        
        $currentBloom = $this->getDomainBloomLevel($state, $domainId);
        
        // Special case: If domain is at L4 with perfect recent performance, 
        // ensure it gets tested at L5 (needs at least 6 questions total)
        if ($currentBloom === 4 && $questionsInDomain < 6) {
            $history = $state['domain_history'][$domainId] ?? [];
            if (count($history) >= 2) {
                // Check last 2 questions
                $recentCorrect = 0;
                for ($i = count($history) - 2; $i < count($history); $i++) {
                    if ($history[$i]) $recentCorrect++;
                }
                if ($recentCorrect === 2) {
                    Log::info('Domain at L4 with perfect performance needs L5 testing', [
                        'domain_id' => $domainId,
                        'questions_so_far' => $questionsInDomain
                    ]);
                    return true;
                }
            }
        }
        
        // Special case: If domain is at L5, ensure it gets at least 2 questions at L5
        // This is required for statistical confidence in Expert level determination
        if ($currentBloom === 5) {
            $questionsAtL5 = $state['domain_attempt_questions'][$domainId][5] ?? 0;
            if ($questionsAtL5 < 2) {
                Log::info('Domain at L5 needs more questions for Expert determination', [
                    'domain_id' => $domainId,
                    'questions_at_L5' => $questionsAtL5,
                    'total_questions' => $questionsInDomain
                ]);
                return true;
            }
        }
        
        // Use attempt questions counter (resets when level changes)
        $questionsAtCurrentAttempt = $state['domain_attempt_questions'][$domainId][$currentBloom] ?? 0;
        $minQuestionsAtLevel = self::BLOOM_MIN_QUESTIONS[$currentBloom] ?? 2;
        
        // Continue if we haven't met minimum questions for this bloom level attempt
        if ($questionsAtCurrentAttempt < $minQuestionsAtLevel) {
            Log::info('Domain needs more questions at current attempt', [
                'domain_id' => $domainId,
                'current_bloom' => $currentBloom,
                'questions_at_attempt' => $questionsAtCurrentAttempt,
                'min_required' => $minQuestionsAtLevel
            ]);
            return true;
        }
        
        // Check if domain just advanced and needs testing at new level
        $domainHistory = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        if (!empty($domainHistory)) {
            $lastIndex = count($domainHistory) - 1;
            $lastQuestionBloom = $bloomHistory[$lastIndex] ?? 0;
            
            // If current bloom level is higher than last question's bloom level,
            // domain just advanced and needs testing at new level
            if ($currentBloom > $lastQuestionBloom && $currentBloom <= 5) {
                Log::info('Domain needs testing at newly advanced level', [
                    'domain_id' => $domainId,
                    'last_question_level' => $lastQuestionBloom,
                    'current_level' => $currentBloom
                ]);
                return true;
            }
        }
        
        // Special handling for L5 (highest level) - smart ceiling test
        if ($currentBloom === 5) {
            // Count questions asked since reaching L5 (including L4 fallbacks)
            $questionsWhileAtL5 = $state['domain_questions_at_l5_level'][$domainId] ?? 0;
            
            // Also calculate actual L5 question performance for scoring
            $correctAtL5 = 0;
            $totalAtL5 = 0;
            $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
            $answerHistory = $state['domain_history'][$domainId] ?? [];
            
            // Count only actual L5 questions for accuracy calculation
            foreach ($bloomHistory as $index => $level) {
                if ($level === 5 && isset($answerHistory[$index])) {
                    $totalAtL5++;
                    if ($answerHistory[$index]) {
                        $correctAtL5++;
                    }
                }
            }
            
            // L5 smart ceiling test: Stop early if clear decision, continue if uncertain
            if ($questionsWhileAtL5 >= 2) {
                // Calculate accuracy based on actual L5 questions only
                $accuracy = $totalAtL5 > 0 ? $correctAtL5 / $totalAtL5 : 0;
                
                // Early stop conditions after 2 questions
                $shouldStop = false;
                $reason = '';
                
                if ($totalAtL5 >= 2) {
                    if ($accuracy == 1.0) {
                        // 2/2 correct = 100% → Confirmed L5 Expert
                        $shouldStop = true;
                        $finalLevel = 5.0;
                        $reason = 'Perfect performance (2/2)';
                    } else if ($accuracy == 0.0) {
                        // 0/2 correct = 0% → Confirmed L4+ (not L5)
                        $shouldStop = true;
                        $finalLevel = 4.5;
                        $reason = 'Failed both L5 questions';
                    } else if ($questionsWhileAtL5 >= 3) {
                        // Had the tiebreaker 3rd question
                        $shouldStop = true;
                        $finalLevel = $accuracy >= 0.6667 ? 5.0 : 4.5;
                        $reason = '3 questions completed';
                    }
                    // If 1/2 (50%), continue to 3rd question
                } else if ($questionsWhileAtL5 >= 3) {
                    // Fallback: Stop after 3 questions regardless
                    $shouldStop = true;
                    $finalLevel = $totalAtL5 == 0 ? 4.5 : ($accuracy >= 0.6667 ? 5.0 : 4.5);
                    $reason = 'Maximum L5 questions reached';
                }
                
                if ($shouldStop) {
                    // Mark the domain as complete
                    if (!isset($state['domain_ceiling_found'])) {
                        $state['domain_ceiling_found'] = [];
                    }
                    $state['domain_ceiling_found'][$domainId] = $finalLevel;
                    
                    Log::info('L5 ceiling test complete', [
                        'domain_id' => $domainId,
                        'questions_at_l5' => $questionsWhileAtL5,
                        'actual_l5_questions' => $totalAtL5,
                        'l5_accuracy' => $totalAtL5 > 0 ? round($accuracy * 100, 2) . '%' : 'N/A',
                        'final_level' => $finalLevel == 5.0 ? 'L5 (Expert)' : 'L4+ (Advanced Plus)',
                        'reason' => $reason
                    ]);
                    return false; // Stop - ceiling test complete
                }
            }
            
            // Continue - need more questions (either < 2 total or 1/2 = 50%)
            Log::info('L5 ceiling test ongoing', [
                'domain_id' => $domainId,
                'questions_at_l5' => $questionsWhileAtL5,
                'actual_l5_questions' => $totalAtL5,
                'accuracy_so_far' => $totalAtL5 > 0 ? round(($correctAtL5 / $totalAtL5) * 100, 2) . '%' : 'N/A',
                'status' => $questionsWhileAtL5 < 2 ? 'Need minimum 2' : 'Need tiebreaker (50% performance)'
            ]);
            return true; // Need more questions
        }
        
        // Check if we've found the ceiling (3+ failures at current level)
        if ($this->hasFoundCeiling($domainId, $currentBloom, $state)) {
            Log::info('Domain ceiling found', [
                'domain_id' => $domainId,
                'bloom_level' => $currentBloom
            ]);
            return false;
        }
        
        // Check if we've found the floor (2+ questions at L1 with accuracy < 75%)
        if ($currentBloom === 1 && $this->hasFoundFloor($domainId, $state)) {
            Log::info('Domain floor found', [
                'domain_id' => $domainId
            ]);
            return false;
        }
        
        // Check performance stability after enough questions
        if ($questionsInDomain >= 10 && $this->hasStablePerformance($domainId, $state)) {
            Log::info('Domain performance stable', [
                'domain_id' => $domainId,
                'questions' => $questionsInDomain
            ]);
            return false;
        }
        
        // Check for uncertain performance zone (between regression and advancement thresholds)
        // This is critical for domains performing between 40-66.67% at L4, for example
        if ($this->isInUncertainZone($domainId, $currentBloom, $state)) {
            // Need more data points for statistical confidence
            $questionsAtLevel = $state['domain_attempt_questions'][$domainId][$currentBloom] ?? 0;
            
            // For uncertain performance, we need at least 3 questions at current level
            if ($questionsAtLevel < 3) {
                Log::info('Domain in uncertain zone needs more questions', [
                    'domain_id' => $domainId,
                    'current_bloom' => $currentBloom,
                    'questions_at_level' => $questionsAtLevel,
                    'performance' => $this->calculateRecentPerformance($domainId, $currentBloom, $state)
                ]);
                return true; // Continue testing
            }
        }
        
        // Continue testing to gather more data
        return true;
    }
    
    /**
     * Check if we've hit the ceiling for a domain (3+ failures at level)
     */
    private function hasFoundCeiling(int $domainId, int $bloomLevel, array $state): bool
    {
        $history = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        $failuresAtLevel = 0;
        for ($i = count($history) - 1; $i >= 0; $i--) {
            // Only count recent questions at this bloom level
            if ($bloomHistory[$i] === $bloomLevel) {
                if (!$history[$i]) {
                    $failuresAtLevel++;
                    if ($failuresAtLevel >= 3) {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * Check if we've hit the floor (2+ questions at L1 with accuracy < 75%)
     */
    private function hasFoundFloor(int $domainId, array $state): bool
    {
        $history = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        $questionsAtL1 = 0;
        $correctAtL1 = 0;
        
        for ($i = 0; $i < count($history); $i++) {
            if ($bloomHistory[$i] === 1) {
                $questionsAtL1++;
                if ($history[$i]) {
                    $correctAtL1++;
                }
            }
        }
        
        // Need at least 2 questions at L1 to determine floor
        if ($questionsAtL1 >= 2) {
            $accuracy = $correctAtL1 / $questionsAtL1;
            // If accuracy < 75%, we've found the floor
            if ($accuracy < 0.75) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Check if performance has stabilized (low variance)
     */
    private function hasStablePerformance(int $domainId, array $state): bool
    {
        $history = $state['domain_history'][$domainId] ?? [];
        
        // Need at least 8 questions for stability check
        if (count($history) < 8) {
            return false;
        }
        
        // Check last 6 questions at same bloom level
        $currentBloom = $this->getDomainBloomLevel($state, $domainId);
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        $recentAtLevel = [];
        for ($i = count($history) - 1; $i >= 0 && count($recentAtLevel) < 6; $i--) {
            if ($bloomHistory[$i] === $currentBloom) {
                $recentAtLevel[] = $history[$i] ? 1 : 0;
            }
        }
        
        if (count($recentAtLevel) < 6) {
            return false;
        }
        
        // Calculate variance
        $mean = array_sum($recentAtLevel) / count($recentAtLevel);
        $variance = 0;
        foreach ($recentAtLevel as $value) {
            $variance += pow($value - $mean, 2);
        }
        $variance = $variance / count($recentAtLevel);
        
        // Low variance means stable performance
        return $variance < 0.1;
    }

    /**
     * Determine if test is complete
     */
    public function isTestComplete(array $state, int $totalQuestions): bool
    {
        // Log the state for debugging
        Log::info('Checking test completion', [
            'total_questions' => $totalQuestions,
            'tested_domains' => count($state['domain_bloom_levels'] ?? []),
            'bloom_stability_counter' => $state['bloom_stability_counter'] ?? 0,
            'state' => $state
        ]);
        
        // Hard limit
        if ($totalQuestions >= 100) {
            Log::info('Test complete: reached 100 questions hard limit');
            return true;
        }
        
        // Check bloom stability (no changes for 4+ questions)
        // BUT ensure we've given domains a chance to reach L5 and prove expertise
        $hasDomainsAtL4WaitingForL5 = false;
        $hasDomainsAtL5NeedingMoreQuestions = false;
        
        foreach ($state['domain_bloom_levels'] ?? [] as $domainId => $level) {
            if ($level === 4) {
                // Check if this L4 domain has high accuracy and could advance
                $questionCount = count($state['domain_history'][$domainId] ?? []);
                Log::info('Checking L4 domain for L5 eligibility', [
                    'domain_id' => $domainId,
                    'current_level' => $level,
                    'question_count' => $questionCount
                ]);
                // Check L4 performance regardless of total question count
                // Domain could have advanced to L4 with just 4 total questions
                $questionsAtL4 = 0;
                $correctAtL4 = 0;
                $history = $state['domain_history'][$domainId] ?? [];
                $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
                
                // Count performance at L4 questions
                for ($i = 0; $i < count($history); $i++) {
                    if (isset($bloomHistory[$i]) && $bloomHistory[$i] === 4) {
                        $questionsAtL4++;
                        if ($history[$i]) $correctAtL4++;
                    }
                }
                
                // Debug L4 performance check
                Log::info('L4 domain performance check', [
                    'domain_id' => $domainId,
                    'questions_at_L4' => $questionsAtL4,
                    'correct_at_L4' => $correctAtL4,
                    'needs_2_questions' => $questionsAtL4 >= 2,
                    'has_good_accuracy' => $questionsAtL4 > 0 ? ($correctAtL4 / $questionsAtL4) >= 0.6667 : false
                ]);
                
                // If 2/2 or better at L4, should advance to L5
                // Statistical confidence requires 2+ questions minimum
                if ($questionsAtL4 >= 2 && ($correctAtL4 / $questionsAtL4) >= 0.6667) {
                    Log::info('Domain at L4 waiting for L5 testing', [
                        'domain_id' => $domainId,
                        'questions_total' => $questionCount,
                        'L4_performance' => "$correctAtL4/$questionsAtL4"
                    ]);
                    $hasDomainsAtL4WaitingForL5 = true;
                    break;
                }
            } elseif ($level === 5) {
                // Check if L5 domain needs more questions for Expert determination
                $questionsAtL5 = $state['domain_attempt_questions'][$domainId][5] ?? 0;
                if ($questionsAtL5 < 2) {
                    Log::info('Domain at L5 needs more questions', [
                        'domain_id' => $domainId,
                        'questions_at_L5' => $questionsAtL5,
                        'needs_minimum' => 2
                    ]);
                    $hasDomainsAtL5NeedingMoreQuestions = true;
                    break;
                }
            }
        }
        
        if (($state['bloom_stability_counter'] ?? 0) >= 4 && 
            $totalQuestions >= 20 && 
            !$hasDomainsAtL4WaitingForL5 && 
            !$hasDomainsAtL5NeedingMoreQuestions) {
            Log::info('Test complete: bloom levels stable for 4+ questions');
            return true;
        }
        
        // Check if all tested domains have reached minimum questions
        $domainQuestionCounts = [];
        foreach ($state['domain_history'] ?? [] as $domainId => $history) {
            $domainQuestionCounts[$domainId] = count($history);
        }
        
        $allDomainsAdequate = true;
        foreach ($domainQuestionCounts as $count) {
            if ($count < self::MIN_QUESTIONS_PER_DOMAIN) {
                $allDomainsAdequate = false;
                break;
            }
        }
        
        // If we've tested 5 domains and all have minimum questions, consider completion
        if (count($domainQuestionCounts) >= 5 && $allDomainsAdequate && $totalQuestions >= 25) {
            Log::info('Test complete: all domains adequately tested');
            return true;
        }
        
        return false;
    }

    /**
     * Calculate final proficiency level with Plus (+) system
     * Returns a value between 1.0 and 5.0 (e.g., 3.5 = Competent+)
     * 
     * Plus levels are awarded when three conditions are met:
     * 1. Stable at Base Level: User meets minimum performance threshold
     * 2. Attempted Next Level: User was tested with 2+ questions at next level
     * 3. Failed to Advance: User did not meet advancement threshold
     */
    public function calculateFinalProficiencyLevel(int $domainId, array $state): float
    {
        $domainHistory = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        if (empty($domainHistory)) {
            return 3.0; // Default to Competent if no data
        }
        
        // Group questions by bloom level
        $questionsByBloom = [];
        foreach ($bloomHistory as $index => $bloomLevel) {
            if (!isset($questionsByBloom[$bloomLevel])) {
                $questionsByBloom[$bloomLevel] = ['correct' => 0, 'total' => 0];
            }
            $questionsByBloom[$bloomLevel]['total']++;
            if ($domainHistory[$index]) {
                $questionsByBloom[$bloomLevel]['correct']++;
            }
        }
        
        // Check L5 first - if achieved, return immediately
        if (isset($questionsByBloom[5]) && $questionsByBloom[5]['total'] >= 2) {
            $l5Accuracy = $questionsByBloom[5]['correct'] / $questionsByBloom[5]['total'];
            if ($l5Accuracy >= 0.6667) {
                return 5.0; // Expert level achieved
            }
        }
        
        // Check levels 1-4 for stable performance and plus level eligibility
        for ($level = 4; $level >= 1; $level--) {
            if (!isset($questionsByBloom[$level]) || $questionsByBloom[$level]['total'] < 2) {
                continue; // Not enough questions at this level
            }
            
            $accuracy = $questionsByBloom[$level]['correct'] / $questionsByBloom[$level]['total'];
            
            // Check if stable at this level based on thresholds
            $isStable = false;
            if ($level === 4 && $accuracy >= 0.40) {
                $isStable = true;
            } elseif ($level === 3 && $accuracy >= 0.34) {
                $isStable = true;
            } elseif ($level === 2 && $accuracy >= 0.25) {
                $isStable = true;
            } elseif ($level === 1 && $accuracy >= 0.25) {
                $isStable = true;
            }
            
            if (!$isStable) {
                continue; // Not stable at this level, try lower
            }
            
            // Stable at this level - check for plus level eligibility
            // Simple 3-condition rule:
            // 1. Stable at Base Level ✓ (already checked above)
            // 2. Attempted Next Level (2+ questions)
            // 3. Failed to Advance (didn't meet next level threshold)
            
            $nextLevel = $level + 1;
            if (isset($questionsByBloom[$nextLevel]) && $questionsByBloom[$nextLevel]['total'] >= 2) {
                $nextAccuracy = $questionsByBloom[$nextLevel]['correct'] / $questionsByBloom[$nextLevel]['total'];
                
                // Check if failed to advance
                $failedToAdvance = false;
                if ($nextLevel === 5 && $nextAccuracy < 0.6667) {
                    $failedToAdvance = true; // Failed L5
                } elseif ($nextLevel === 4 && $nextAccuracy < 0.6667) {
                    $failedToAdvance = true; // Failed L4
                } elseif ($nextLevel === 3 && $nextAccuracy < 0.75) {
                    $failedToAdvance = true; // Failed L3
                } elseif ($nextLevel === 2 && $nextAccuracy < 0.75) {
                    $failedToAdvance = true; // Failed L2
                }
                
                if ($failedToAdvance) {
                    return $level + 0.5; // Plus level
                }
            }
            
            // Stable but didn't attempt next level or passed next level
            return (float) $level;
        }
        
        // Default to L1 if no stable level found
        return 1.0;
    }
    
    /**
     * Get proficiency level label for a numeric level
     */
    public function getProficiencyLabel(float $level): string
    {
        $labels = [
            5.0 => 'Expert',
            4.5 => 'Advanced+',
            4.0 => 'Advanced',
            3.5 => 'Competent+',
            3.0 => 'Competent',
            2.5 => 'Foundational+',
            2.0 => 'Foundational',
            1.5 => 'Beginner+',
            1.0 => 'Beginner'
        ];
        
        return $labels[$level] ?? 'Unknown';
    }
    
    /**
     * Calculate domain performance from responses
     */
    public function calculateDomainPerformance(int $diagnosticId): array
    {
        $responses = DiagnosticResponse::where('diagnostic_id', $diagnosticId)
            ->with('diagnosticItem.topic.domain')
            ->get();
            
        $performance = [];
        
        foreach ($responses as $response) {
            $domainId = $response->diagnosticItem->topic->domain_id;
            $bloomLevel = $response->diagnosticItem->bloom_level;
            
            if (!isset($performance[$domainId])) {
                $performance[$domainId] = [];
            }
            
            if (!isset($performance[$domainId][$bloomLevel])) {
                $performance[$domainId][$bloomLevel] = ['correct' => 0, 'total' => 0];
            }
            
            $performance[$domainId][$bloomLevel]['total']++;
            if ($response->is_correct) {
                $performance[$domainId][$bloomLevel]['correct']++;
            }
        }
        
        return $performance;
    }
    
    /**
     * Select next question based on hybrid round-robin + adaptive strategy
     */
    public function selectNextQuestion(array $state, array $existingQuestionIds, int $phaseId): ?array
    {
        // Get domain question counts from state
        $domainQuestionCounts = [];
        foreach ($state['domain_history'] ?? [] as $domainId => $history) {
            $domainQuestionCounts[$domainId] = count($history);
        }
        
        Log::info('🎯 Question Selection Starting', [
            'existing_questions' => count($existingQuestionIds),
            'domain_counts' => $domainQuestionCounts,
            'current_bloom_levels' => $state['domain_bloom_levels'] ?? [],
            'phase_id' => $phaseId
        ]);
        
        // Get all domains in current phase
        $phaseDomainIds = \App\Models\DiagnosticDomain::where('phase_id', $phaseId)
            ->where('is_active', true)
            ->orderBy('id') // Ensure consistent ordering for round robin
            ->pluck('id')
            ->toArray();
        
        // Track last tested domain for round robin
        $lastTestedDomain = $state['last_tested_domain'] ?? null;
        
        // Priority 0: L4 domains with perfect performance ready for L5
        // This takes precedence over round-robin to ensure L5 testing
        $l4DomainsReadyForL5 = [];
        foreach ($phaseDomainIds as $domainId) {
            $currentLevel = $state['domain_bloom_levels'][$domainId] ?? 3;
            if ($currentLevel === 4) {
                // Check recent L4 performance
                $history = $state['domain_history'][$domainId] ?? [];
                $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
                $questionCount = count($history);
                
                // Count L4 questions regardless of total count
                $l4Questions = 0;
                $l4Correct = 0;
                for ($i = 0; $i < count($history); $i++) {
                    if (isset($bloomHistory[$i]) && $bloomHistory[$i] === 4) {
                        $l4Questions++;
                        if ($history[$i]) $l4Correct++;
                    }
                }
                
                // If 2+ questions at L4 with good performance, prioritize for L5
                if ($l4Questions >= 2 && ($l4Correct / $l4Questions) >= 0.6667) {
                    $l4DomainsReadyForL5[] = $domainId;
                }
            }
        }
        
        // If we have L4 domains ready for L5, test them first
        if (!empty($l4DomainsReadyForL5)) {
            $targetDomainId = $l4DomainsReadyForL5[0]; // Take first one
            $targetBloomLevel = 5; // Force L5 testing
            
            Log::info('📈 SELECTION REASON: L4→L5 Advancement Testing', [
                'domain_id' => $targetDomainId,
                'target_bloom' => $targetBloomLevel,
                'l4_domains_ready' => $l4DomainsReadyForL5,
                'selection_priority' => 'HIGH - L5 testing'
            ]);
        } else {
            // Priority 0.5: L5 domains that need more questions for Expert determination
            $l5DomainsNeedingMoreQuestions = [];
            foreach ($phaseDomainIds as $domainId) {
                $currentLevel = $state['domain_bloom_levels'][$domainId] ?? 3;
                if ($currentLevel === 5) {
                    $questionsAtL5 = $state['domain_attempt_questions'][$domainId][5] ?? 0;
                    if ($questionsAtL5 < 2) {
                        $l5DomainsNeedingMoreQuestions[] = $domainId;
                    }
                }
            }
            
            if (!empty($l5DomainsNeedingMoreQuestions)) {
                $targetDomainId = $l5DomainsNeedingMoreQuestions[0]; // Take first one
                $targetBloomLevel = 5; // Continue L5 testing
                
                Log::info('🎓 SELECTION REASON: L5 Expert Confirmation', [
                    'domain_id' => $targetDomainId,
                    'target_bloom' => $targetBloomLevel,
                    'questions_at_L5' => $state['domain_attempt_questions'][$targetDomainId][5] ?? 0,
                    'selection_priority' => 'HIGH - L5 confirmation'
                ]);
            } else {
                // No L4 or L5 priority domains, proceed with normal selection
                
                // Phase 1: Round Robin until all domains have minimum questions
                $domainsNeedingMinimum = [];
                foreach ($phaseDomainIds as $domainId) {
                    $count = $domainQuestionCounts[$domainId] ?? 0;
                    if ($count < self::MIN_QUESTIONS_PER_DOMAIN) {
                        $domainsNeedingMinimum[] = $domainId;
                    }
                }
                
                if (!empty($domainsNeedingMinimum)) {
                    // Round robin through domains needing minimum
                    $targetDomainId = $this->getNextRoundRobinDomain($domainsNeedingMinimum, $lastTestedDomain);
                    $targetBloomLevel = $state['domain_bloom_levels'][$targetDomainId] ?? 3;
                    
                    Log::info('🔄 SELECTION REASON: Round-Robin Minimum Coverage', [
                        'domain_id' => $targetDomainId,
                        'target_bloom' => $targetBloomLevel,
                        'questions_so_far' => $domainQuestionCounts[$targetDomainId] ?? 0,
                        'domains_needing_minimum' => $domainsNeedingMinimum,
                        'selection_priority' => 'MEDIUM - minimum coverage'
                    ]);
                } else {
                    // Phase 2: All domains have minimum, now use adaptive strategy
                    $targetDomainId = null;
                    
                    // Priority 1: Domains with uncertain performance (40-70% at current level)
                    $uncertainDomains = $this->getUncertainDomains($phaseDomainIds, $state);
                    if (!empty($uncertainDomains)) {
                        $targetDomainId = $uncertainDomains[0]; // Take first uncertain domain
                    }
                    
                    // Priority 2: Domains showing excellence that haven't reached L5
                    if (!$targetDomainId) {
                        $excellentDomains = $this->getExcellentDomains($phaseDomainIds, $state);
                        if (!empty($excellentDomains)) {
                            // Prioritize L4 domains ready for L5 testing
                            usort($excellentDomains, function($a, $b) use ($state) {
                                $levelA = $state['domain_bloom_levels'][$a] ?? 3;
                                $levelB = $state['domain_bloom_levels'][$b] ?? 3;
                                return $levelB <=> $levelA; // Higher levels first
                            });
                            $targetDomainId = $excellentDomains[0];
                        }
                    }
                    
                    // Priority 3: Any domain that should continue testing
                    if (!$targetDomainId) {
                        foreach ($phaseDomainIds as $domainId) {
                            $count = $domainQuestionCounts[$domainId] ?? 0;
                            if ($this->shouldContinueDomain($domainId, $count, $state)) {
                                $targetDomainId = $domainId;
                                break;
                            }
                        }
                    }
                    
                    if ($targetDomainId) {
                        $targetBloomLevel = $state['domain_bloom_levels'][$targetDomainId] ?? 3;
                    }
                }
            }
        }
        
        if (!$targetDomainId) {
            return null; // No more questions needed
        }
        
        // Find available questions at target bloom level
        Log::info('🔍 Searching for questions', [
            'domain_id' => $targetDomainId,
            'target_bloom_level' => $targetBloomLevel,
            'excluded_questions' => count($existingQuestionIds)
        ]);
        
        $availableQuestions = $this->findAvailableQuestions(
            $targetDomainId, 
            $targetBloomLevel, 
            $existingQuestionIds
        );
        
        if (empty($availableQuestions)) {
            // No valid questions available - domain test should stop
            Log::warning('❌ No valid questions available', [
                'domain_id' => $targetDomainId,
                'target_bloom' => $targetBloomLevel,
                'reason' => 'Insufficient questions at required level',
                'excluded_count' => count($existingQuestionIds)
            ]);
            
            // Return special marker to indicate domain should stop
            return [
                'stop_domain' => true,
                'domain_id' => $targetDomainId,
                'reason' => 'no_questions_available',
                'final_level' => $targetBloomLevel - 0.5 // Cap at "plus" level
            ];
        }
        
        // Return random question from available pool
        $selectedQuestion = $availableQuestions[array_rand($availableQuestions)];
        
        return [
            'question_id' => $selectedQuestion['id'],
            'domain_id' => $targetDomainId,
            'bloom_level' => $selectedQuestion['bloom_level'],
            'target_bloom_level' => $targetBloomLevel,
            'last_tested_domain' => $targetDomainId // Track for round robin
        ];
    }
    
    /**
     * Find available questions for a domain at specified bloom level
     * CRITICAL: Never return questions from lower bloom levels
     */
    private function findAvailableQuestions(int $domainId, int $targetBloomLevel, array $excludeIds): array
    {
        $questions = [];
        
        // 1. Try exact bloom level
        $questions = DiagnosticItem::where('status', 'published')
            ->whereNotIn('id', $excludeIds)
            ->where('bloom_level', $targetBloomLevel)
            ->whereHas('topic.domain', function($query) use ($domainId) {
                $query->where('id', $domainId);
            })
            ->get();
            
        if ($questions->isNotEmpty()) {
            Log::info('✅ Found exact bloom level questions', [
                'domain_id' => $domainId,
                'target_bloom' => $targetBloomLevel,
                'count' => $questions->count(),
                'question_ids' => $questions->pluck('id')->toArray()
            ]);
            return $questions->toArray();
        } else {
            Log::info('⚠️ No exact bloom level questions', [
                'domain_id' => $domainId,
                'target_bloom' => $targetBloomLevel,
                'will_check_fallback' => true
            ]);
        }
        
        // 2. Try HIGHER levels only (no lower level fallbacks)
        // This maintains assessment integrity - testing at L4 with L5 questions is valid
        // But testing at L4 with L3 questions is not
        if ($targetBloomLevel < 5) {
            $higherLevels = range($targetBloomLevel + 1, 5);
            
            $questions = DiagnosticItem::where('status', 'published')
                ->whereNotIn('id', $excludeIds)
                ->whereIn('bloom_level', $higherLevels)
                ->whereHas('topic.domain', function($query) use ($domainId) {
                    $query->where('id', $domainId);
                })
                ->orderBy('bloom_level') // Prefer closest higher level
                ->get();
                
            if ($questions->isNotEmpty()) {
                Log::info('⬆️ Using HIGHER level questions (valid fallback)', [
                    'domain_id' => $domainId,
                    'target_bloom' => $targetBloomLevel,
                    'actual_bloom_levels' => $questions->pluck('bloom_level')->unique()->sort()->values()->toArray(),
                    'count' => $questions->count(),
                    'question_ids' => $questions->pluck('id')->take(5)->toArray() // Show first 5
                ]);
                return $questions->toArray();
            }
        }
        
        // 3. No valid questions available - return empty array
        // The domain test should stop rather than compromise validity
        Log::warning('No valid questions available for bloom level', [
            'domain_id' => $domainId,
            'target_bloom' => $targetBloomLevel,
            'excluded_count' => count($excludeIds),
            'action' => 'Domain test should stop'
        ]);
        
        return []; // Empty array signals no valid questions
    }
    
    /**
     * Get next domain in round robin order
     */
    private function getNextRoundRobinDomain(array $availableDomains, ?int $lastDomain): int
    {
        if (empty($availableDomains)) {
            return 0;
        }
        
        // If no last domain or last domain not in available list, start from beginning
        if (!$lastDomain || !in_array($lastDomain, $availableDomains)) {
            return $availableDomains[0];
        }
        
        // Find next domain after the last one
        $currentIndex = array_search($lastDomain, $availableDomains);
        $nextIndex = ($currentIndex + 1) % count($availableDomains);
        
        return $availableDomains[$nextIndex];
    }
    
    /**
     * Get domains with uncertain performance (40-70% at current level)
     */
    private function getUncertainDomains(array $domainIds, array $state): array
    {
        $uncertainDomains = [];
        
        foreach ($domainIds as $domainId) {
            if (!isset($state['domain_bloom_levels'][$domainId])) {
                continue;
            }
            
            $currentBloom = $state['domain_bloom_levels'][$domainId];
            $history = $state['domain_history'][$domainId] ?? [];
            $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
            
            // Calculate accuracy at current bloom level
            $correctAtLevel = 0;
            $totalAtLevel = 0;
            
            foreach ($bloomHistory as $index => $level) {
                if ($level === $currentBloom) {
                    $totalAtLevel++;
                    if ($history[$index]) {
                        $correctAtLevel++;
                    }
                }
            }
            
            if ($totalAtLevel >= 2) {
                $accuracy = $correctAtLevel / $totalAtLevel;
                // Check if in uncertainty zone (between regression and advancement thresholds)
                $regressThreshold = self::BLOOM_REGRESS_THRESHOLDS[$currentBloom] ?? 0;
                $advanceThreshold = self::BLOOM_ADVANCE_THRESHOLDS[$currentBloom] ?? 1;
                
                if ($accuracy > $regressThreshold && $accuracy < $advanceThreshold) {
                    $uncertainDomains[] = $domainId;
                }
            }
        }
        
        return $uncertainDomains;
    }
    
    /**
     * Get domains showing excellent performance that could advance
     */
    private function getExcellentDomains(array $domainIds, array $state): array
    {
        $excellentDomains = [];
        
        foreach ($domainIds as $domainId) {
            if (!isset($state['domain_bloom_levels'][$domainId])) {
                continue;
            }
            
            $currentBloom = $state['domain_bloom_levels'][$domainId];
            
            // Skip if already at L5
            if ($currentBloom >= 5) {
                continue;
            }
            
            $history = $state['domain_history'][$domainId] ?? [];
            $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
            
            // Check recent performance
            $recentCorrect = 0;
            $recentTotal = 0;
            $lastIndex = count($history) - 1;
            
            // Look at last 2-3 questions
            for ($i = max(0, $lastIndex - 2); $i <= $lastIndex; $i++) {
                if (isset($bloomHistory[$i]) && $bloomHistory[$i] === $currentBloom) {
                    $recentTotal++;
                    if ($history[$i]) {
                        $recentCorrect++;
                    }
                }
            }
            
            // If perfect or near-perfect recent performance
            if ($recentTotal >= 2 && $recentCorrect / $recentTotal >= 0.75) {
                $excellentDomains[] = $domainId;
            }
        }
        
        return $excellentDomains;
    }
    
    /**
     * Get detailed bloom progression for a domain
     */
    public function getDomainBloomProgression(int $diagnosticId, int $domainId): array
    {
        $responses = DiagnosticResponse::where('diagnostic_id', $diagnosticId)
            ->whereHas('diagnosticItem.topic', function($query) use ($domainId) {
                $query->where('domain_id', $domainId);
            })
            ->with('diagnosticItem')
            ->orderBy('id')
            ->get();
            
        $progression = [];
        $currentLevel = 3; // Starting level
        $streak = ['correct' => 0, 'incorrect' => 0];
        $questionsAtLevel = [3 => 0];
        
        foreach ($responses as $index => $response) {
            $bloomLevel = $response->diagnosticItem->bloom_level;
            $isCorrect = $response->is_correct;
            
            // Track questions at this level
            if (!isset($questionsAtLevel[$bloomLevel])) {
                $questionsAtLevel[$bloomLevel] = 0;
            }
            $questionsAtLevel[$bloomLevel]++;
            
            // Update streaks
            if ($isCorrect) {
                $streak['correct']++;
                $streak['incorrect'] = 0;
            } else {
                $streak['incorrect']++;
                $streak['correct'] = 0;
            }
            
            $progression[] = [
                'question_num' => $index + 1,
                'bloom_level' => $bloomLevel,
                'is_correct' => $isCorrect,
                'current_streak' => $streak,
                'questions_at_level' => $questionsAtLevel[$bloomLevel]
            ];
        }
        
        return $progression;
    }
    
    /**
     * Get warm-start level for a domain based on previous assessments
     * 
     * @param int $userId
     * @param int $domainId
     * @return int|null Returns starting bloom level (1-4) or null if no warm-start data
     */
    public function getWarmStartLevel(int $userId, int $domainId): ?int
    {
        // Get recent diagnostic profile (within 90 days)
        $profile = \App\Models\DiagnosticProfile::where('user_id', $userId)
            ->where('domain_id', $domainId)
            ->where('last_assessed_at', '>', now()->subDays(90))
            ->orderBy('last_assessed_at', 'desc')
            ->first();
        
        if (!$profile) {
            return null; // No warm-start data
        }
        
        // Apply time-based decay
        $daysSince = $profile->last_assessed_at->diffInDays(now());
        $decay = floor($daysSince / 180); // -1 level per 6 months
        
        // Get the integer part of proficiency level (e.g., 3.5 -> 3)
        $baseLevel = floor($profile->proficiency_level);
        
        // Calculate starting level with decay
        $startLevel = max(1, $baseLevel - $decay);
        $startLevel = min(4, $startLevel); // Cap at L4
        
        Log::info('Warm-start level calculated', [
            'user_id' => $userId,
            'domain_id' => $domainId,
            'previous_level' => $profile->proficiency_level,
            'days_since' => $daysSince,
            'decay' => $decay,
            'warm_start_level' => $startLevel
        ]);
        
        return (int) $startLevel;
    }
    
    /**
     * Check if domain is in uncertain performance zone
     * (between regression and advancement thresholds)
     */
    private function isInUncertainZone(int $domainId, int $bloomLevel, array $state): bool
    {
        $performance = $this->calculateRecentPerformance($domainId, $bloomLevel, $state);
        
        // If we don't have enough data, we're not in uncertain zone yet
        if ($performance === null) {
            return false;
        }
        
        // Get thresholds for current level
        $advanceThreshold = self::BLOOM_ADVANCE_THRESHOLDS[$bloomLevel] ?? 0.75;
        $regressThreshold = self::BLOOM_REGRESS_THRESHOLDS[$bloomLevel] ?? 0.25;
        
        // Check if performance is between thresholds
        // For L4: between 40% (regress) and 66.67% (advance)
        return $performance > $regressThreshold && $performance < $advanceThreshold;
    }
    
    /**
     * Calculate recent performance at current bloom level
     */
    private function calculateRecentPerformance(int $domainId, int $bloomLevel, array $state): ?float
    {
        $history = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        
        // Count questions at current bloom level
        $questionsAtLevel = 0;
        $correctAtLevel = 0;
        
        for ($i = 0; $i < count($history); $i++) {
            if (isset($bloomHistory[$i]) && $bloomHistory[$i] === $bloomLevel) {
                $questionsAtLevel++;
                if ($history[$i]) {
                    $correctAtLevel++;
                }
            }
        }
        
        // Need at least 2 questions for performance calculation
        if ($questionsAtLevel < 2) {
            return null;
        }
        
        return $correctAtLevel / $questionsAtLevel;
    }
}