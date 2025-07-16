<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Diagnostic;
use App\Models\DiagnosticResponse;
use App\Models\DiagnosticItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DiagnosticBot extends Command
{
    protected $signature = 'diagnostic:bot 
                            {--user= : User ID to run the bot as}
                            {--strategy=mixed : Answer strategy: always-correct, always-wrong, mixed, smart}
                            {--accuracy=70 : Target accuracy percentage for mixed/smart strategies}
                            {--details : Show detailed progress}
                            {--show-selection : Show question selection reasoning}
                            {--fresh : Clear previous diagnostic profiles for truly fresh start}';

    protected $description = 'Bot to automatically take diagnostic assessments for testing';

    private $baseUrl;
    private $cookies = [];
    private $token;

    public function handle()
    {
        $userId = $this->option('user') ?? 1;
        $strategy = $this->option('strategy');
        $targetAccuracy = (int) $this->option('accuracy');
        
        $user = User::find($userId);
        if (!$user) {
            $this->error('User not found');
            return 1;
        }

        $this->info("🤖 Diagnostic Bot Starting");
        $this->info("User: {$user->name} (ID: {$user->id})");
        $this->info("Strategy: {$strategy}");
        $this->info("Target Accuracy: {$targetAccuracy}%");
        
        // Clear previous profiles if --fresh flag is used
        if ($this->option('fresh')) {
            \App\Models\DiagnosticProfile::where('user_id', $user->id)->delete();
            $this->info("🧹 Cleared previous diagnostic profiles for fresh start");
        }
        
        $this->newLine();

        // Start a new diagnostic
        $diagnostic = $this->startNewDiagnostic($user);
        if (!$diagnostic) {
            $this->error('Failed to start diagnostic');
            return 1;
        }

        $this->info("✅ Started Diagnostic ID: {$diagnostic->id}");
        $this->newLine();

        // Take the assessment
        $questionCount = 0;
        $correctCount = 0;
        $domainStats = [];

        while ($diagnostic->status === 'in_progress') {
            $questionCount++;
            
            // Get current question
            $currentResponse = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->whereNull('user_answer')
                ->with(['diagnosticItem.topic.domain', 'diagnosticItem'])
                ->first();

            if (!$currentResponse) {
                $this->warn('No unanswered question found');
                break;
            }

            $item = $currentResponse->diagnosticItem;
            $domain = $item->topic->domain->name;
            $bloomLevel = $item->bloom_level;

            // Initialize domain stats
            if (!isset($domainStats[$domain])) {
                $domainStats[$domain] = [
                    'questions' => 0,
                    'correct' => 0,
                    'bloom_levels' => [],
                    'last_results' => []
                ];
            }

            // Determine answer based on strategy
            $shouldAnswerCorrectly = $this->shouldAnswerCorrectly(
                $strategy, 
                $targetAccuracy, 
                $correctCount, 
                $questionCount,
                $domainStats[$domain],
                $bloomLevel
            );

            // Get the answer options
            $options = $item->options ?? [];
            $correctOptions = $item->correct_options ?? [];
            
            // Select answer
            if ($shouldAnswerCorrectly) {
                $selectedAnswer = $correctOptions;
                $correctCount++;
                $domainStats[$domain]['correct']++;
            } else {
                // Pick a wrong answer
                $wrongOptions = array_values(array_diff(array_keys($options), $correctOptions));
                $selectedAnswer = !empty($wrongOptions) ? [$wrongOptions[0]] : [0];
            }

            // Submit answer
            $responseTime = rand(5, 30); // Simulate thinking time
            $this->submitAnswer($diagnostic, $currentResponse, $selectedAnswer, $responseTime);
            
            // Show question selection reasoning if requested
            if ($this->option('show-selection')) {
                $this->displaySelectionReasoning($diagnostic->id);
            }

            // Track stats
            $domainStats[$domain]['questions']++;
            $domainStats[$domain]['bloom_levels'][] = $bloomLevel;
            $domainStats[$domain]['last_results'][] = $shouldAnswerCorrectly;

            // Display progress
            $accuracy = $questionCount > 0 ? round(($correctCount / $questionCount) * 100, 1) : 0;
            $result = $shouldAnswerCorrectly ? '✓' : '✗';
            
            if ($this->option('details')) {
                $this->info("Q{$questionCount}: {$domain} (L{$bloomLevel}) - {$result} | Overall: {$accuracy}%");
            } else {
                $this->output->write($result);
                if ($questionCount % 50 === 0) {
                    $this->output->write(" [{$questionCount}]");
                    $this->newLine();
                }
            }

            // Refresh diagnostic
            $diagnostic->refresh();
            
            // Safety check to prevent infinite loops
            if ($questionCount > 200) {
                $this->warn('Safety limit reached (200 questions)');
                break;
            }
        }

        $this->newLine(2);
        $this->info("🏁 Assessment Complete!");
        $this->info("Total Questions: {$questionCount}");
        $this->info("Correct Answers: {$correctCount}");
        $this->info("Final Accuracy: " . round(($correctCount / $questionCount) * 100, 1) . "%");
        $this->newLine();

        // Display domain breakdown
        $this->info("Domain Breakdown:");
        $headers = ['Domain', 'Questions', 'Correct', 'Accuracy', 'Bloom Range', 'Progression'];
        $rows = [];
        
        foreach ($domainStats as $domain => $stats) {
            $domainAccuracy = $stats['questions'] > 0 
                ? round(($stats['correct'] / $stats['questions']) * 100, 1) . '%'
                : '0%';
            
            $bloomRange = $stats['questions'] > 0
                ? min($stats['bloom_levels']) . '-' . max($stats['bloom_levels'])
                : 'N/A';
                
            // Show ACTUAL bloom level progression with results
            $progression = $this->buildBloomProgression($domain, $diagnostic->id);
            
            $rows[] = [
                substr($domain, 0, 30),
                $stats['questions'],
                $stats['correct'],
                $domainAccuracy,
                $bloomRange,
                $progression
            ];
        }
        
        $this->table($headers, $rows);
        
        // Run analysis command
        $this->newLine();
        $this->info("Running diagnostic analysis...");
        $this->call('diagnostic:analyze', ['diagnostic' => $diagnostic->id]);
        
        // Show proficiency levels
        $this->newLine();
        $this->info("Proficiency Levels:");
        $finalState = json_decode($diagnostic->adaptive_state, true);
        $proficiencyService = new \App\Services\AdaptiveDiagnosticService();
        
        foreach ($domainStats as $domain => $stats) {
            // Find domain ID
            $domainModel = \App\Models\DiagnosticDomain::where('name', $domain)->first();
            if ($domainModel) {
                $proficiencyLevel = $proficiencyService->calculateFinalProficiencyLevel($domainModel->id, $finalState);
                $label = $proficiencyService->getProficiencyLabel($proficiencyLevel);
                $this->info(sprintf("  %s: %.1f - %s", 
                    substr($domain, 0, 30), 
                    $proficiencyLevel, 
                    $label
                ));
            }
        }

        return 0;
    }
    
    /**
     * Build actual bloom level progression for a domain in chronological order
     */
    private function buildBloomProgression(string $domainName, int $diagnosticId): string
    {
        // Get all responses for this domain in chronological order
        $responses = DiagnosticResponse::where('diagnostic_id', $diagnosticId)
            ->whereHas('diagnosticItem.topic.domain', function($query) use ($domainName) {
                $query->where('name', $domainName);
            })
            ->with('diagnosticItem')
            ->whereNotNull('is_correct')
            ->orderBy('id') // Chronological order
            ->get();
        
        if ($responses->isEmpty()) {
            return 'N/A';
        }
        
        $progression = [];
        foreach ($responses as $response) {
            $bloomLevel = $response->diagnosticItem->bloom_level;
            $result = $response->is_correct ? '✓' : '✗';
            $progression[] = "{$bloomLevel}{$result}";
        }
        
        // Show all if ≤ 10, otherwise show first 3 and last 7
        if (count($progression) <= 10) {
            return implode(' → ', $progression);
        } else {
            $start = array_slice($progression, 0, 3);
            $end = array_slice($progression, -7);
            return implode(' → ', $start) . ' → ... → ' . implode(' → ', $end);
        }
    }
    
    private function displaySelectionReasoning(int $diagnosticId): void
    {
        // Read the last few log entries related to question selection
        $logPath = storage_path('logs/laravel.log');
        if (!file_exists($logPath)) {
            return;
        }
        
        // Get last 200 lines from log
        $lines = array_slice(file($logPath), -200);
        $selectionLogs = [];
        
        foreach ($lines as $line) {
            // Look for our question selection log markers
            if (strpos($line, '🎯 Question Selection Starting') !== false ||
                strpos($line, '📈 SELECTION REASON:') !== false ||
                strpos($line, '🎓 SELECTION REASON:') !== false ||
                strpos($line, '🔄 SELECTION REASON:') !== false ||
                strpos($line, '🔍 Searching for questions') !== false ||
                strpos($line, '✅ Found exact bloom level') !== false ||
                strpos($line, '⚠️ No exact bloom level') !== false ||
                strpos($line, '⬇️ Using LOWER level questions') !== false) {
                
                // Extract the JSON part
                if (preg_match('/\{.*\}/', $line, $matches)) {
                    $json = json_decode($matches[0], true);
                    if ($json) {
                        $selectionLogs[] = $json;
                    }
                }
            }
        }
        
        if (!empty($selectionLogs)) {
            $this->newLine();
            $this->info('📋 Question Selection Logic:');
            
            // Show the most recent selection reasoning
            $recent = array_slice($selectionLogs, -5);
            foreach ($recent as $log) {
                if (isset($log['selection_priority'])) {
                    $this->line("  → {$log['selection_priority']}");
                    if (isset($log['domain_id'])) {
                        $domain = \App\Models\DiagnosticDomain::find($log['domain_id']);
                        $this->line("    Domain: " . ($domain ? $domain->name : "ID {$log['domain_id']}"));
                    }
                    if (isset($log['target_bloom'])) {
                        $this->line("    Target Level: L{$log['target_bloom']}");
                    }
                } elseif (isset($log['domain_id']) && isset($log['target_bloom'])) {
                    $this->line("  → Question search for Domain {$log['domain_id']} at L{$log['target_bloom']}");
                    if (isset($log['count'])) {
                        $this->line("    Found: {$log['count']} questions");
                    }
                }
            }
            $this->newLine();
        }
    }

    private function startNewDiagnostic(User $user): ?Diagnostic
    {
        // Simulate API call to start diagnostic
        // In reality, you'd make HTTP requests, but for testing we'll use direct model access
        
        // Create diagnostic
        $adaptiveService = new \App\Services\AdaptiveDiagnosticService();
        $initialState = $adaptiveService->initializeTest();
        
        $diagnostic = Diagnostic::create([
            'user_id' => $user->id,
            'status' => 'in_progress',
            'phase_id' => 1, // Start with phase 1
            'adaptive_state' => json_encode($initialState)
        ]);

        // Generate first question
        $this->generateFirstQuestion($diagnostic);

        return $diagnostic;
    }

    private function generateFirstQuestion(Diagnostic $diagnostic): void
    {
        // Get a random question from phase 1
        $firstQuestion = DiagnosticItem::whereHas('topic.domain', function ($query) {
                $query->where('phase_id', 1);
            })
            ->where('bloom_level', 3) // Start at Apply level
            ->inRandomOrder()
            ->first();

        if ($firstQuestion) {
            DiagnosticResponse::create([
                'diagnostic_id' => $diagnostic->id,
                'diagnostic_item_id' => $firstQuestion->id,
                'user_answer' => null,
                'is_correct' => null,
                'response_time_seconds' => null,
            ]);
        }
    }

    private function submitAnswer(Diagnostic $diagnostic, DiagnosticResponse $response, array $selectedAnswer, int $responseTime): void
    {
        // Get correct answers
        $correctAnswers = $response->diagnosticItem->correct_options ?? [];
        
        // Check if answer is correct
        $isCorrect = !empty(array_intersect($selectedAnswer, $correctAnswers)) && 
                    count($selectedAnswer) === count($correctAnswers);

        // Update response
        $response->update([
            'user_answer' => $selectedAnswer,
            'is_correct' => $isCorrect,
            'response_time_seconds' => $responseTime,
        ]);

        // Update diagnostic duration
        $diagnostic->increment('total_duration_seconds', $responseTime);

        // Process adaptive state
        $adaptiveService = new \App\Services\AdaptiveDiagnosticService();
        $adaptiveState = json_decode($diagnostic->adaptive_state, true);
        // For bot testing, don't pass user ID to avoid warm-start contamination
        $adaptiveState = $adaptiveService->processAnswer($adaptiveState, $response->diagnosticItem, $isCorrect, null);
        
        // Check if complete
        $totalAnswered = $diagnostic->responses()->whereNotNull('user_answer')->count();
        $isComplete = $adaptiveService->isTestComplete($adaptiveState, $totalAnswered);

        if ($isComplete) {
            // Calculate final score
            $correctCount = $diagnostic->responses()->where('is_correct', true)->count();
            $score = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100, 2) : 0;
            
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
                'score' => $score,
                'adaptive_state' => json_encode($adaptiveState)
            ]);
        } else {
            // Save adaptive state and generate next question
            $diagnostic->update(['adaptive_state' => json_encode($adaptiveState)]);
            
            // Get existing question IDs to avoid duplicates
            $existingQuestionIds = $diagnostic->responses()->pluck('diagnostic_item_id')->toArray();
            
            // Generate next question using the adaptive service
            $nextQuestion = $adaptiveService->selectNextQuestion(
                $adaptiveState,
                $existingQuestionIds,
                $diagnostic->phase_id
            );
            
            if ($nextQuestion) {
                // Update state with last tested domain for round-robin tracking
                if (isset($nextQuestion['last_tested_domain'])) {
                    $adaptiveState['last_tested_domain'] = $nextQuestion['last_tested_domain'];
                    $diagnostic->update(['adaptive_state' => json_encode($adaptiveState)]);
                }
                
                // Create response for next question
                DiagnosticResponse::create([
                    'diagnostic_id' => $diagnostic->id,
                    'diagnostic_item_id' => $nextQuestion['question_id'],
                    'user_answer' => null,
                    'is_correct' => null,
                    'response_time_seconds' => null,
                ]);
            } else {
                // No more questions available, complete the assessment
                $correctCount = $diagnostic->responses()->where('is_correct', true)->count();
                $totalAnswered = $diagnostic->responses()->whereNotNull('user_answer')->count();
                $score = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100, 2) : 0;
                
                $diagnostic->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                    'score' => $score,
                    'adaptive_state' => json_encode($adaptiveState)
                ]);
            }
        }
    }

    private function shouldAnswerCorrectly(
        string $strategy, 
        int $targetAccuracy, 
        int $correctCount, 
        int $questionCount,
        array $domainStats,
        int $bloomLevel
    ): bool {
        switch ($strategy) {
            case 'always-correct':
                return true;
                
            case 'always-wrong':
                return false;
                
            case 'mixed':
                // Random based on target accuracy
                return rand(1, 100) <= $targetAccuracy;
                
            case 'smart':
                // Intelligent strategy that adapts based on bloom level
                // Higher bloom levels are harder, so lower success rate
                $bloomDifficulty = [
                    1 => 90, // Remember - very easy
                    2 => 80, // Understand - easy
                    3 => 70, // Apply - moderate
                    4 => 60, // Analyze - hard
                    5 => 50, // Evaluate - very hard
                    6 => 40, // Create - extremely hard
                ];
                
                $baseChance = $bloomDifficulty[$bloomLevel] ?? 70;
                
                // Adjust based on current accuracy to maintain target
                if ($questionCount > 10) {
                    $currentAccuracy = ($correctCount / $questionCount) * 100;
                    if ($currentAccuracy < $targetAccuracy - 5) {
                        $baseChance += 10; // Answer more correctly
                    } elseif ($currentAccuracy > $targetAccuracy + 5) {
                        $baseChance -= 10; // Answer more incorrectly
                    }
                }
                
                // Add some streaks for realism (3-4 correct in a row sometimes)
                $recentResults = array_slice($domainStats['last_results'], -3);
                if (count($recentResults) >= 3 && count(array_filter($recentResults)) === 3) {
                    // After 3 correct, maybe make a mistake
                    $baseChance -= 20;
                } elseif (count($recentResults) >= 2 && count(array_filter($recentResults)) === 0) {
                    // After 2 wrong, try to get one right
                    $baseChance += 20;
                }
                
                return rand(1, 100) <= $baseChance;
                
            default:
                return rand(1, 100) <= 70; // Default 70% accuracy
        }
    }
}