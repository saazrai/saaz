<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use App\Models\DiagnosticItem;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class AnalyzeDiagnostic extends Command
{
    protected $signature = 'diagnostic:analyze 
                          {diagnostic : The diagnostic ID to analyze}
                          {--detailed : Show detailed question-by-question analysis}
                          {--simulate : Simulate what the adaptive algorithm should have done}';

    protected $description = 'Analyze a diagnostic to understand bloom level progression and why it took many questions';

    private $domains = [];
    private $bloomLevels = [
        1 => 'Remember',
        2 => 'Understand',
        3 => 'Apply',
        4 => 'Analyze',
        5 => 'Evaluate',
        6 => 'Create'
    ];
    
    private $difficultyLevels = [
        1 => 'Very Easy',
        2 => 'Easy',
        3 => 'Medium',
        4 => 'Hard',
        5 => 'Very Hard'
    ];

    public function handle()
    {
        $diagnosticId = $this->argument('diagnostic');
        $diagnostic = Diagnostic::with(['user', 'responses.diagnosticItem.topic.domain'])
            ->find($diagnosticId);

        if (!$diagnostic) {
            $this->error("Diagnostic with ID {$diagnosticId} not found.");
            return 1;
        }

        $this->analyzeDiagnostic($diagnostic);
        return 0;
    }

    private function analyzeDiagnostic(Diagnostic $diagnostic)
    {
        $this->info("=== DIAGNOSTIC ANALYSIS ===");
        $this->displayDiagnosticInfo($diagnostic);
        
        $responses = $diagnostic->responses->sortBy('created_at');
        
        if ($responses->isEmpty()) {
            $this->warn("No diagnostic responses found.");
            return;
        }

        $this->newLine();
        $this->analyzeBloomProgression($responses);
        
        $this->newLine();
        $this->analyzeDomainDistribution($responses);
        
        $this->newLine();
        $this->analyzeStoppingCriteria($responses, $diagnostic);
        
        if ($this->option('detailed')) {
            $this->newLine();
            $this->detailedQuestionAnalysis($responses);
        }
        
        // Add chronological flow
        $this->newLine();
        $this->displayChronologicalFlow($responses);
        
        if ($this->option('simulate')) {
            $this->newLine();
            $this->simulateAdaptiveAlgorithm($responses);
        }
        
        $this->newLine();
        $this->explainQuestionCount($responses, $diagnostic);
        
        $this->newLine();
        $this->analyzeProficiencySummary($responses);
    }

    private function displayDiagnosticInfo(Diagnostic $diagnostic)
    {
        $duration = $diagnostic->total_duration_seconds 
            ? gmdate("H:i:s", $diagnostic->total_duration_seconds)
            : 'N/A';
            
        $this->table(
            ['Field', 'Value'],
            [
                ['User', $diagnostic->user->name ?? 'Unknown'],
                ['Status', ucfirst($diagnostic->status)],
                ['Current Phase', $diagnostic->phase?->order_sequence ?? 'N/A'],
                ['Total Questions', $diagnostic->responses->count()],
                ['Duration', $duration],
                ['Score', $diagnostic->score ? round($diagnostic->score, 1) . '%' : 'N/A'],
                ['Created', $diagnostic->created_at->format('Y-m-d H:i:s')],
            ]
        );
    }

    private function analyzeBloomProgression($responses)
    {
        $this->info("BLOOM LEVEL PROGRESSION BY DOMAIN:");
        
        $domainBloomProgression = [];
        $overallProgression = [];
        
        // Collect bloom progression by domain with correct/incorrect
        foreach ($responses as $index => $response) {
            $item = $response->diagnosticItem;
            if (!$item) continue;
            
            $domain = $item->topic->domain->name ?? 'Unknown';
            $bloomLevel = $item->bloom_level ?? 3;
            $isCorrect = $response->is_correct;
            
            // Track domain bloom progression with results
            if (!isset($domainBloomProgression[$domain])) {
                $domainBloomProgression[$domain] = [];
            }
            
            $domainBloomProgression[$domain][] = [
                'level' => $bloomLevel,
                'correct' => $isCorrect,
                'question_num' => $index + 1
            ];
            
            // Track overall progression
            $overallProgression[] = [
                'domain' => $domain,
                'level' => $bloomLevel,
                'correct' => $isCorrect
            ];
        }
        
        // Display bloom progression for each domain
        foreach ($domainBloomProgression as $domain => $progressions) {
            $this->newLine();
            $this->line("<fg=cyan;options=bold>{$domain}:</>");
            
            // Build progression string with line breaks every 15 items
            $progressionParts = [];
            foreach ($progressions as $i => $prog) {
                $icon = $prog['correct'] ? '✓' : '✗';
                $color = $prog['correct'] ? 'green' : 'red';
                $progressionParts[] = "<fg={$color}>{$prog['level']}{$icon}</>";
                
                // Add line break and indentation every 15 items
                if (($i + 1) % 15 === 0 && $i < count($progressions) - 1) {
                    $progressionParts[] = "\n  ";
                }
            }
            
            $this->line("  " . implode(' → ', $progressionParts));
            
            // Summary stats for domain
            $levels = array_column($progressions, 'level');
            $correctCount = count(array_filter($progressions, fn($p) => $p['correct']));
            $totalCount = count($progressions);
            $accuracy = round(($correctCount / $totalCount) * 100, 1);
            $avgLevel = round(array_sum($levels) / count($levels), 1);
            $levelRange = min($levels) . '-' . max($levels);
            
            $this->line("  <fg=gray>Questions: {$totalCount} | Accuracy: {$accuracy}% | Avg Level: {$avgLevel} | Range: {$levelRange}</>");
        }
        
        // Overall summary table
        $this->newLine();
        $this->info("SUMMARY TABLE:");
        
        $summaryData = [];
        $consecutiveIncorrect = 0;
        $maxConsecutive = 0;
        
        foreach ($overallProgression as $index => $item) {
            if (!$item['correct']) {
                $consecutiveIncorrect++;
                $maxConsecutive = max($maxConsecutive, $consecutiveIncorrect);
            } else {
                $consecutiveIncorrect = 0;
            }
            
            // Show every 10th question
            if ($index % 10 === 0 || $index === count($overallProgression) - 1) {
                $summaryData[] = [
                    'Question' => $index + 1,
                    'Domain' => substr($item['domain'], 0, 20),
                    'Level' => $item['level'],
                    'Result' => $item['correct'] ? '✓' : '✗',
                    'Consec. Incorrect' => $consecutiveIncorrect
                ];
            }
        }
        
        $this->table(
            ['Question', 'Domain', 'Level', 'Result', 'Consec. Incorrect'],
            $summaryData
        );
        
        $this->line("Max consecutive incorrect: {$maxConsecutive}");
        $this->newLine();
        $this->line("<fg=gray>Legend: ✓ = Correct, ✗ = Incorrect</>");
    }

    private function analyzeDomainDistribution($responses)
    {
        $this->info("DOMAIN DISTRIBUTION:");
        
        $domainStats = [];
        $adaptiveService = app(\App\Services\AdaptiveDiagnosticService::class);
        
        foreach ($responses as $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$item->topic || !$item->topic->domain) continue;
            
            $domain = $item->topic->domain->name;
            $domainId = $item->topic->domain->id;
            
            if (!isset($domainStats[$domain])) {
                $domainStats[$domain] = [
                    'id' => $domainId,
                    'count' => 0,
                    'correct' => 0,
                    'bloom_levels' => [],
                    'answers' => [],
                    'bloom_history' => [],
                ];
            }
            
            $domainStats[$domain]['count']++;
            if ($response->is_correct) {
                $domainStats[$domain]['correct']++;
            }
            $domainStats[$domain]['bloom_levels'][] = $item->bloom_level ?? 3;
            $domainStats[$domain]['answers'][] = $response->is_correct;
            $domainStats[$domain]['bloom_history'][] = $item->bloom_level ?? 3;
        }
        
        $tableData = [];
        foreach ($domainStats as $domain => $stats) {
            $accuracy = $stats['count'] > 0 
                ? round(($stats['correct'] / $stats['count']) * 100, 1) 
                : 0;
            
            $avgBloom = count($stats['bloom_levels']) > 0
                ? round(array_sum($stats['bloom_levels']) / count($stats['bloom_levels']), 1)
                : 0;
                
            $bloomRange = count($stats['bloom_levels']) > 0
                ? min($stats['bloom_levels']) . '-' . max($stats['bloom_levels'])
                : 'N/A';
            
            // Calculate proficiency level using the adaptive service
            $state = [
                'domain_history' => [$stats['id'] => $stats['answers']],
                'domain_bloom_history' => [$stats['id'] => $stats['bloom_history']]
            ];
            
            $proficiencyLevel = $adaptiveService->calculateFinalProficiencyLevel($stats['id'], $state);
            $proficiencyLabel = $adaptiveService->getProficiencyLabel($proficiencyLevel);
            
            $tableData[] = [
                $domain,
                $stats['count'],
                $stats['correct'] . '/' . $stats['count'],
                $accuracy . '%',
                $avgBloom,
                $bloomRange,
                $proficiencyLevel . ' - ' . $proficiencyLabel
            ];
        }
        
        $this->table(
            ['Domain', 'Questions', 'Correct', 'Accuracy', 'Avg Bloom', 'Bloom Range', 'Proficiency Level'],
            $tableData
        );
    }

    private function analyzeStoppingCriteria($responses, $diagnostic)
    {
        $this->info("STOPPING CRITERIA ANALYSIS:");
        
        $totalQuestions = count($responses);
        $lastResponses = $responses->slice(-10);
        
        // Check various stopping criteria
        $criteria = [];
        
        // 1. Maximum questions reached
        $maxQuestions = 100; // Typical maximum
        if ($totalQuestions >= $maxQuestions) {
            $criteria[] = "✅ Maximum questions reached ({$totalQuestions}/{$maxQuestions})";
        } else {
            $criteria[] = "❌ Maximum questions not reached ({$totalQuestions}/{$maxQuestions})";
        }
        
        // 2. Bloom level stability
        $bloomStable = $this->checkBloomStability($responses);
        if ($bloomStable) {
            $criteria[] = "✅ Bloom level stable (no change in last 4+ questions)";
        } else {
            $criteria[] = "❌ Bloom level still changing";
        }
        
        // 3. Consecutive incorrect answers
        $maxConsecutiveIncorrect = 0;
        $currentConsecutive = 0;
        foreach ($responses as $response) {
            if (!$response->is_correct) {
                $currentConsecutive++;
                $maxConsecutiveIncorrect = max($maxConsecutiveIncorrect, $currentConsecutive);
            } else {
                $currentConsecutive = 0;
            }
        }
        
        if ($maxConsecutiveIncorrect >= 5) {
            $criteria[] = "✅ Too many consecutive incorrect answers ({$maxConsecutiveIncorrect})";
        } else {
            $criteria[] = "❌ No excessive consecutive incorrect answers (max: {$maxConsecutiveIncorrect})";
        }
        
        // 4. Domain coverage
        $domains = $responses->map(function($r) {
            return $r->diagnosticItem->topic->domain->name ?? null;
        })->filter()->unique();
        
        $minQuestionsPerDomain = 5;
        $domainCoverage = [];
        foreach ($domains as $domain) {
            $count = $responses->filter(function($r) use ($domain) {
                return ($r->diagnosticItem->topic->domain->name ?? null) === $domain;
            })->count();
            
            if ($count >= $minQuestionsPerDomain) {
                $domainCoverage[$domain] = "✅ {$count} questions";
            } else {
                $domainCoverage[$domain] = "❌ {$count} questions (min: {$minQuestionsPerDomain})";
            }
        }
        
        $allDomainsCovered = !collect($domainCoverage)->contains(fn($v) => str_starts_with($v, '❌'));
        if ($allDomainsCovered) {
            $criteria[] = "✅ All domains adequately covered";
        } else {
            $criteria[] = "❌ Some domains need more coverage";
        }
        
        foreach ($criteria as $criterion) {
            $this->line("  " . $criterion);
        }
        
        if (!$allDomainsCovered) {
            $this->newLine();
            $this->line("  Domain Coverage:");
            foreach ($domainCoverage as $domain => $status) {
                $this->line("    {$domain}: {$status}");
            }
        }
    }

    private function checkBloomStability($responses): bool
    {
        if (count($responses) < 10) return false;
        
        $lastResponses = $responses->slice(-5);
        $bloomLevels = $lastResponses->map(function($r) {
            return $r->diagnosticItem->bloom_level ?? 3;
        });
        
        // Check if bloom levels are stable (not changing much)
        $uniqueLevels = $bloomLevels->unique()->count();
        return $uniqueLevels <= 2; // Stable if only 1-2 different levels in last 5 questions
    }

    private function detailedQuestionAnalysis($responses)
    {
        $this->info("DETAILED QUESTION ANALYSIS:");
        
        // First table: Basic question info
        $headers = ['#', 'Domain', 'Topic', 'Bloom', 'Type', 'Difficulty', 'Result', 'Time (s)'];
        $rows = [];
        
        foreach ($responses as $index => $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$response->user_answer) continue;
            
            $domain = $item->topic->domain->name ?? 'Unknown';
            $topic = $item->topic->name ?? 'Unknown';
            
            // Truncate long names
            $domainShort = strlen($domain) > 25 ? substr($domain, 0, 22) . '...' : $domain;
            $topicShort = strlen($topic) > 20 ? substr($topic, 0, 17) . '...' : $topic;
            
            $rows[] = [
                $index + 1,
                $domainShort,
                $topicShort,
                $item->bloom_level ?? 3,
                $this->getQuestionTypeName($item->type_id),
                $this->getDifficultyName($item->difficulty_level),
                $response->is_correct ? '✓' : '✗',
                $response->response_time_seconds ?? 0,
            ];
        }
        
        $this->table($headers, $rows);
        
        $this->newLine();
        $this->info("DETAILED RESPONSE ANALYSIS:");
        
        // Second table: Response details
        $responseHeaders = ['#', 'User Answer', 'Correct Answer', 'Options Selected', 'Points'];
        $responseRows = [];
        
        foreach ($responses as $index => $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$response->user_answer) continue;
            
            $userAnswer = is_array($response->user_answer) ? implode(', ', $response->user_answer) : $response->user_answer;
            $correctAnswer = is_array($item->correct_options) ? implode(', ', $item->correct_options) : $item->correct_options;
            
            // Get option labels if available
            $optionLabels = [];
            if (is_array($response->user_answer) && is_array($item->options)) {
                foreach ($response->user_answer as $optionIndex) {
                    if (isset($item->options[$optionIndex])) {
                        $optionText = $item->options[$optionIndex];
                        // Handle if option is an array (e.g., matching questions)
                        if (is_array($optionText)) {
                            $optionText = json_encode($optionText);
                        }
                        $optionLabels[] = "({$optionIndex}) " . substr($optionText, 0, 30);
                    }
                }
            }
            $optionText = !empty($optionLabels) ? implode('; ', $optionLabels) : 'N/A';
            
            $points = $response->is_correct ? 1 : 0;
            
            $responseRows[] = [
                $index + 1,
                $userAnswer,
                $correctAnswer,
                substr($optionText, 0, 50) . (strlen($optionText) > 50 ? '...' : ''),
                $points
            ];
        }
        
        $this->table($responseHeaders, array_slice($responseRows, 0, 20));
        
        if (count($responseRows) > 20) {
            $this->line("... showing first 20 of {$responses->count()} questions");
            $this->line("Use --all flag to see all questions");
        }
    }
    
    private function getDifficultyName($level): string
    {
        return $this->difficultyLevels[$level] ?? 'Medium';
    }
    
    private function getQuestionTypeName($typeId): string
    {
        $types = [
            1 => 'MCQ',
            2 => 'Multiple',
            3 => 'TrueFalse',
            4 => 'Matching',
            5 => 'Ordering',
            6 => 'FillBlank',
            7 => 'Essay',
            8 => 'Code'
        ];
        
        return $types[$typeId] ?? 'Unknown';
    }
    
    private function displayChronologicalFlow($responses)
    {
        $this->info("CHRONOLOGICAL QUESTION FLOW:");
        
        $headers = ['Q#', 'Domain', 'Bloom', 'Result', 'Adaptive State', 'Time', 'Domain Progress'];
        $rows = [];
        
        // Track domain question counts
        $domainCounts = [];
        $domainIds = [];
        
        // Get the diagnostic to access adaptive state history
        $diagnostic = $responses->first()->diagnostic ?? null;
        
        foreach ($responses as $index => $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$response->user_answer) continue;
            
            $domain = $item->topic->domain->name ?? 'Unknown';
            $domainId = $item->topic->domain->id ?? 0;
            $domainShort = strlen($domain) > 20 ? substr($domain, 0, 17) . '...' : $domain;
            
            // Store domain ID mapping
            if (!isset($domainIds[$domain])) {
                $domainIds[$domain] = $domainId;
            }
            
            // Update domain count
            if (!isset($domainCounts[$domain])) {
                $domainCounts[$domain] = 0;
            }
            $domainCounts[$domain]++;
            
            // Get REAL adaptive state from the diagnostic's adaptive_state JSON
            // This represents the state AFTER processing this response
            $adaptiveStateData = $diagnostic ? $diagnostic->adaptive_state : null;
            $currentAdaptiveLevel = 3; // Default
            $previousAdaptiveLevel = 3;
            
            if ($adaptiveStateData && isset($adaptiveStateData['domain_bloom_levels'][$domainId])) {
                $currentAdaptiveLevel = $adaptiveStateData['domain_bloom_levels'][$domainId];
                
                // To get the previous state, we'd need to track history
                // For now, detect changes based on bloom level differences
                if ($domainCounts[$domain] > 1) {
                    // Check if this question's bloom level indicates a test at higher level
                    if ($item->bloom_level > $currentAdaptiveLevel) {
                        // Testing for advancement
                        $previousAdaptiveLevel = $item->bloom_level - 1;
                    } else {
                        $previousAdaptiveLevel = $currentAdaptiveLevel;
                    }
                }
            }
            
            $stateChange = '';
            if ($currentAdaptiveLevel > $previousAdaptiveLevel) {
                $stateChange = '↑';
            } elseif ($currentAdaptiveLevel < $previousAdaptiveLevel) {
                $stateChange = '↓';
            }
            
            // Format as "X of Y" where X is question count and Y is domain ID
            $domainProgress = $domainCounts[$domain] . ' of ' . $domainId;
            
            $rows[] = [
                $index + 1,
                $domainShort,
                $item->bloom_level,
                $response->is_correct ? '✓' : '✗',
                $currentAdaptiveLevel . $stateChange,
                $response->response_time_seconds . 's',
                $domainProgress
            ];
        }
        
        $this->table($headers, $rows);
        
        // Summary of domain visits
        $this->newLine();
        $this->info("DOMAIN VISIT PATTERN:");
        $domainPattern = [];
        foreach ($responses as $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$response->user_answer) continue;
            $domain = $item->topic->domain->name ?? 'Unknown';
            $domainInitial = substr($domain, 0, 3);
            $domainPattern[] = $domainInitial;
        }
        
        // Display in chunks of 20
        $chunks = array_chunk($domainPattern, 20);
        foreach ($chunks as $i => $chunk) {
            $this->line(($i * 20 + 1) . "-" . ($i * 20 + count($chunk)) . ": " . implode(' → ', $chunk));
        }
    }

    private function simulateAdaptiveAlgorithm($responses)
    {
        $this->info("ADAPTIVE ALGORITHM SIMULATION:");
        
        $simulatedBloomLevels = [];
        $currentBloomLevel = 3; // Starting level
        
        foreach ($responses as $index => $response) {
            $isCorrect = $response->is_correct;
            
            // Simulate bloom level adjustment
            if ($isCorrect) {
                $currentBloomLevel = min(6, $currentBloomLevel + 0.5);
            } else {
                $currentBloomLevel = max(1, $currentBloomLevel - 0.5);
            }
            
            $simulatedBloomLevels[] = round($currentBloomLevel);
            
            // Check if we should have stopped
            if ($index >= 30) { // Minimum questions
                // Check stability
                $recent = array_slice($simulatedBloomLevels, -5);
                if (count(array_unique($recent)) === 1) {
                    $this->line("Simulation suggests stopping at question " . ($index + 1) . " (bloom stable at " . end($recent) . ")");
                    break;
                }
            }
        }
        
        $actualQuestions = $responses->count();
        $simulatedQuestions = count($simulatedBloomLevels);
        
        $this->line("Actual questions: {$actualQuestions}");
        $this->line("Simulated questions: {$simulatedQuestions}");
        
        if ($simulatedQuestions < $actualQuestions * 0.8) {
            $this->warn("The adaptive algorithm might not be terminating properly.");
        }
    }

    private function explainQuestionCount($responses, $diagnostic)
    {
        $this->info("WHY DID THIS ASSESSMENT TAKE {$responses->count()} QUESTIONS?");
        
        $reasons = [];
        
        // 1. Check starting bloom level
        $firstBloomLevels = $responses->take(5)->map(function($r) {
            return $r->diagnosticItem->bloom_level ?? 3;
        });
        $avgFirstBloom = $firstBloomLevels->avg();
        if ($avgFirstBloom > 4 || $avgFirstBloom < 2) {
            $reasons[] = "• Started at inappropriate bloom level (avg: " . round($avgFirstBloom, 1) . ")";
        }
        
        // 2. Check bloom level variance
        $allBloomLevels = $responses->map(function($r) {
            return $r->diagnosticItem->bloom_level ?? 3;
        });
        $bloomVariance = $allBloomLevels->unique()->count();
        if ($bloomVariance >= 4) {
            $reasons[] = "• High bloom level variation ({$bloomVariance} different levels) indicates knowledge gaps";
        }
        
        // 3. Check accuracy patterns
        $accuracy = $responses->where('is_correct', true)->count() / $responses->count() * 100;
        if ($accuracy >= 30 && $accuracy <= 70) {
            $reasons[] = "• Mixed performance (" . round($accuracy, 1) . "% accuracy) prevents early termination";
        }
        
        // 4. Check domain count
        $domainCount = $responses->map(function($r) {
            return $r->diagnosticItem->topic->domain->name ?? null;
        })->filter()->unique()->count();
        if ($domainCount >= 5) {
            $reasons[] = "• Testing many domains ({$domainCount}) requires more questions";
        }
        
        // 5. Check for performance instability
        $chunks = $responses->chunk(10);
        $chunkAccuracies = $chunks->map(function($chunk) {
            return $chunk->where('is_correct', true)->count() / $chunk->count() * 100;
        });
        $accuracyVariance = $chunkAccuracies->max() - $chunkAccuracies->min();
        if ($accuracyVariance > 40) {
            $reasons[] = "• Unstable performance (accuracy variance: " . round($accuracyVariance, 1) . "%)";
        }
        
        // 6. Minimum coverage requirements
        $minQuestionsPerDomain = 5;
        $totalMinRequired = $domainCount * $minQuestionsPerDomain;
        if ($totalMinRequired > 50) {
            $reasons[] = "• Minimum domain coverage requires at least {$totalMinRequired} questions";
        }
        
        if (empty($reasons)) {
            $reasons[] = "• Assessment length appears normal for comprehensive coverage";
        }
        
        foreach ($reasons as $reason) {
            $this->line($reason);
        }
        
        $this->newLine();
        $this->info("RECOMMENDATIONS:");
        
        if ($avgFirstBloom > 4) {
            $this->line("• Consider starting with easier questions for better calibration");
        }
        if ($bloomVariance >= 4) {
            $this->line("• Focus on specific bloom levels to reduce assessment length");
        }
        if ($domainCount >= 5) {
            $this->line("• Consider splitting into domain-specific assessments");
        }
        if ($accuracyVariance > 40) {
            $this->line("• Investigate causes of performance instability");
        }
    }
    
    private function analyzeProficiencySummary($responses)
    {
        $this->info("PROFICIENCY LEVEL SUMMARY:");
        
        $adaptiveService = app(\App\Services\AdaptiveDiagnosticService::class);
        $domainProficiencies = [];
        
        // Group responses by domain
        foreach ($responses as $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$item->topic || !$item->topic->domain) continue;
            
            $domainId = $item->topic->domain->id;
            $domainName = $item->topic->domain->name;
            
            if (!isset($domainProficiencies[$domainId])) {
                $domainProficiencies[$domainId] = [
                    'name' => $domainName,
                    'answers' => [],
                    'bloom_history' => []
                ];
            }
            
            $domainProficiencies[$domainId]['answers'][] = $response->is_correct;
            $domainProficiencies[$domainId]['bloom_history'][] = $item->bloom_level ?? 3;
        }
        
        // Calculate and display proficiency levels
        $proficiencyData = [];
        $totalLevel = 0;
        $domainCount = 0;
        
        foreach ($domainProficiencies as $domainId => $data) {
            $state = [
                'domain_history' => [$domainId => $data['answers']],
                'domain_bloom_history' => [$domainId => $data['bloom_history']]
            ];
            
            $level = $adaptiveService->calculateFinalProficiencyLevel($domainId, $state);
            $label = $adaptiveService->getProficiencyLabel($level);
            
            $proficiencyData[] = [
                'domain' => $data['name'],
                'level' => $level,
                'label' => $label,
                'questions' => count($data['answers'])
            ];
            
            $totalLevel += $level;
            $domainCount++;
        }
        
        // Sort by proficiency level descending
        usort($proficiencyData, function($a, $b) {
            return $b['level'] <=> $a['level'];
        });
        
        // Display summary
        foreach ($proficiencyData as $prof) {
            $levelStr = number_format($prof['level'], 1);
            $color = $this->getProficiencyColor($prof['level']);
            $this->line("<fg={$color}>• {$prof['domain']}: {$levelStr} - {$prof['label']} ({$prof['questions']} questions)</>");
        }
        
        if ($domainCount > 0) {
            $avgLevel = $totalLevel / $domainCount;
            $avgLabel = $adaptiveService->getProficiencyLabel(round($avgLevel * 2) / 2); // Round to nearest 0.5
            $this->newLine();
            $this->line("<fg=white;bg=blue> Average Proficiency: " . number_format($avgLevel, 1) . " - {$avgLabel} </>");
        }
    }
    
    private function getProficiencyColor($level)
    {
        if ($level >= 4.5) return 'bright-green';
        if ($level >= 3.5) return 'green';
        if ($level >= 2.5) return 'yellow';
        if ($level >= 1.5) return 'bright-red';
        return 'red';
    }
}