<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticResponse;
use App\Models\User;
use App\Services\AdaptiveDiagnosticService;
use Illuminate\Console\Command;

class DiagnosticTestCase extends Command
{
    protected $signature = 'diagnostic:test 
                            {--case= : Test case number (1-10)}
                            {--user= : User ID to run the test as}
                            {--list : List all available test cases}
                            {--single-domain : Focus on a single domain (disable rotation)}';

    protected $description = 'Run specific diagnostic test cases from documentation';

    private $testCases = [
        1 => [
            'name' => 'Straight Expert Path',
            'pattern' => 'L3✓✓ → L4✓✓ → L5✓✓ = L5.0',
            'description' => 'Perfect performance leading to Expert level',
            'sequence' => [
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 4, 'correct' => true],
                ['level' => 4, 'correct' => true],
                ['level' => 5, 'correct' => true],
                ['level' => 5, 'correct' => true],
            ],
        ],
        2 => [
            'name' => 'Straight Beginner Path',
            'pattern' => 'L3✗✗ → L2✗✗ → L1✗✗✗ = L1.0',
            'description' => 'Consistent failures leading to Beginner level',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 1, 'correct' => false],
                ['level' => 1, 'correct' => false],
                ['level' => 1, 'correct' => false],
            ],
        ],
        3 => [
            'name' => 'L3 Attempt to L2+',
            'pattern' => 'L3✗✓✗ → L2✓✗ = L2.5',
            'description' => 'Failed L3, stable at L2, results in Foundational+',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => true],
                ['level' => 2, 'correct' => false],
            ],
        ],
        4 => [
            'name' => 'Standard Advancement',
            'pattern' => 'L3✓✗✓ → L4✓✗✓ → L5✓✗✓ = L5.0',
            'description' => '66.67% accuracy at each level',
            'sequence' => [
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => true],
                ['level' => 4, 'correct' => true],
                ['level' => 4, 'correct' => false],
                ['level' => 4, 'correct' => true],
                ['level' => 5, 'correct' => true],
                ['level' => 5, 'correct' => false],
                ['level' => 5, 'correct' => true],
            ],
        ],
        5 => [
            'name' => 'Quick Drop',
            'pattern' => 'L3✗✗ → L2✗✗ → L1✗✓✗✓ = L1.5',
            'description' => 'Rapid regression to L1, then stable',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 1, 'correct' => false],
                ['level' => 1, 'correct' => true],
                ['level' => 1, 'correct' => false],
                ['level' => 1, 'correct' => true],
            ],
        ],
        6 => [
            'name' => 'Recovery Pattern',
            'pattern' => 'L3✗✗ → L2✓✓ → L3✓✓✓✗ = L3.0',
            'description' => 'Regress then recover to stable L3',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => true],
                ['level' => 2, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => false],
            ],
        ],
        7 => [
            'name' => 'Plateau at L2',
            'pattern' => 'L3✗✗ → L2✓✗✓✗ = L2.5',
            'description' => 'Regress to L2 and stabilize',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => true],
                ['level' => 2, 'correct' => false],
                ['level' => 2, 'correct' => true],
                ['level' => 2, 'correct' => false],
            ],
        ],
        8 => [
            'name' => 'L4 Ceiling Found',
            'pattern' => 'L3✓✓ → L4✗✓✗ = L3.5',
            'description' => 'Perfect L3, but fails at L4',
            'sequence' => [
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 4, 'correct' => false],
                ['level' => 4, 'correct' => true],
                ['level' => 4, 'correct' => false],
            ],
        ],
        9 => [
            'name' => 'Near Miss Expert',
            'pattern' => 'L3✓✓ → L4✓✓ → L5✓✗✗ = L4.5',
            'description' => 'Perfect through L4, fails L5 ceiling test',
            'sequence' => [
                ['level' => 3, 'correct' => true],
                ['level' => 3, 'correct' => true],
                ['level' => 4, 'correct' => true],
                ['level' => 4, 'correct' => true],
                ['level' => 5, 'correct' => true],
                ['level' => 5, 'correct' => false],
                ['level' => 5, 'correct' => false],
            ],
        ],
        10 => [
            'name' => 'L1 Plus Level',
            'pattern' => 'L3✗✗ → L2✗✗ → L1✓✓ → L2✗✗ = L1.5',
            'description' => 'Proves L1, attempts but fails L2',
            'sequence' => [
                ['level' => 3, 'correct' => false],
                ['level' => 3, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 2, 'correct' => false],
                ['level' => 1, 'correct' => true],
                ['level' => 1, 'correct' => true],
                ['level' => 2, 'correct' => false],
                ['level' => 2, 'correct' => false],
            ],
        ],
    ];

    public function handle()
    {
        if ($this->option('list')) {
            $this->listTestCases();

            return 0;
        }

        $caseNumber = $this->option('case');
        if (! $caseNumber) {
            $this->error('Please specify a test case number with --case=N (1-10)');
            $this->info('Use --list to see all available test cases');

            return 1;
        }

        if (! isset($this->testCases[$caseNumber])) {
            $this->error("Invalid test case number: $caseNumber");
            $this->info('Valid test cases are 1-10. Use --list to see details.');

            return 1;
        }

        $testCase = $this->testCases[$caseNumber];
        $userId = $this->option('user') ?? 1;

        $user = User::find($userId);
        if (! $user) {
            $this->error('User not found');

            return 1;
        }

        $this->info("🧪 Running Test Case #$caseNumber: {$testCase['name']}");
        $this->info("Pattern: {$testCase['pattern']}");
        $this->info("Description: {$testCase['description']}");
        $this->newLine();

        // Start diagnostic
        $diagnostic = $this->startDiagnostic($user);
        $this->info("✅ Started Diagnostic ID: {$diagnostic->id}");
        $this->newLine();

        // Execute test sequence
        $this->executeTestSequence($diagnostic, $testCase['sequence']);

        // Show results
        $this->showResults($diagnostic);

        return 0;
    }

    private function listTestCases()
    {
        $this->info('Available Test Cases:');
        $this->newLine();

        foreach ($this->testCases as $number => $testCase) {
            $this->info("Test Case #$number: {$testCase['name']}");
            $this->line("  Pattern: {$testCase['pattern']}");
            $this->line("  {$testCase['description']}");
            $this->newLine();
        }
    }

    private function startDiagnostic(User $user): Diagnostic
    {
        $adaptiveService = new AdaptiveDiagnosticService;
        $initialState = $adaptiveService->initializeTest();

        $diagnostic = Diagnostic::create([
            'user_id' => $user->id,
            'status' => 'in_progress',
            'phase_id' => 1,
            'adaptive_state' => json_encode($initialState),
        ]);

        // Get first question from first domain
        $firstDomain = \App\Models\DiagnosticDomain::where('phase_id', 1)
            ->orderBy('priority_order')
            ->first();

        if ($firstDomain) {
            $firstQuestion = DiagnosticItem::whereHas('topic', function ($query) use ($firstDomain) {
                $query->where('domain_id', $firstDomain->id);
            })
                ->where('bloom_level', 3)
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

        return $diagnostic;
    }

    private function executeTestSequence(Diagnostic $diagnostic, array $sequence)
    {
        $adaptiveService = new AdaptiveDiagnosticService;
        $questionCount = 0;
        $targetDomainId = null;

        foreach ($sequence as $step) {
            $questionCount++;

            // Get current unanswered question
            $currentResponse = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->whereNull('user_answer')
                ->with(['diagnosticItem.subtopic.topic.domain'])
                ->first();

            if (! $currentResponse) {
                $this->warn("No unanswered question found at step $questionCount");
                break;
            }

            $item = $currentResponse->diagnosticItem;
            $actualLevel = $item->bloom_level;
            $expectedLevel = $step['level'];

            // Track the domain we're testing
            if (! $targetDomainId) {
                $targetDomainId = $item->topic->domain->id;
                $this->info("Testing Domain: {$item->topic->domain->name}");
                $this->newLine();
            }

            // Verify we're at the expected level
            if ($actualLevel !== $expectedLevel) {
                $this->comment("Note: Expected L{$expectedLevel}, got L{$actualLevel} (may be due to question availability)");
            }

            // Submit answer
            $isCorrect = $step['correct'];
            $this->submitAnswer($diagnostic, $currentResponse, $isCorrect);

            // Display progress
            $symbol = $isCorrect ? '✓' : '✗';
            $domain = substr($item->topic->domain->name, 0, 20);
            $this->info("Q{$questionCount}: L{$actualLevel} - {$symbol}");

            // Refresh diagnostic
            $diagnostic->refresh();

            // Check if we're still testing the same domain
            if ($item->topic->domain->id !== $targetDomainId) {
                $this->comment('Domain switched - test pattern may not complete as expected');
                break;
            }
        }
    }

    private function submitAnswer(Diagnostic $diagnostic, DiagnosticResponse $response, bool $shouldBeCorrect)
    {
        $item = $response->diagnosticItem;
        $correctAnswers = $item->correct_options ?? [];
        $options = $item->options ?? [];

        if ($shouldBeCorrect) {
            $selectedAnswer = $correctAnswers;
        } else {
            $wrongOptions = array_values(array_diff(array_keys($options), $correctAnswers));
            $selectedAnswer = ! empty($wrongOptions) ? [$wrongOptions[0]] : [0];
        }

        // Update response
        $response->update([
            'user_answer' => $selectedAnswer,
            'is_correct' => $shouldBeCorrect,
            'response_time_seconds' => rand(5, 30),
        ]);

        // Update adaptive state
        $adaptiveService = new AdaptiveDiagnosticService;
        $adaptiveState = json_decode($diagnostic->adaptive_state, true);
        $adaptiveState = $adaptiveService->processAnswer($adaptiveState, $item, $shouldBeCorrect);

        // Check if complete
        $totalAnswered = $diagnostic->responses()->whereNotNull('user_answer')->count();
        $isComplete = $adaptiveService->isTestComplete($adaptiveState, $totalAnswered);

        if ($isComplete) {
            $correctCount = $diagnostic->responses()->where('is_correct', true)->count();
            $score = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100, 2) : 0;

            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
                'score' => $score,
                'adaptive_state' => json_encode($adaptiveState),
            ]);
        } else {
            $diagnostic->update(['adaptive_state' => json_encode($adaptiveState)]);

            // Generate next question
            $existingQuestionIds = $diagnostic->responses()->pluck('diagnostic_item_id')->toArray();
            $nextQuestion = $adaptiveService->selectNextQuestion(
                $adaptiveState,
                $existingQuestionIds,
                $diagnostic->phase_id
            );

            if ($nextQuestion) {
                if (isset($nextQuestion['last_tested_domain'])) {
                    $adaptiveState['last_tested_domain'] = $nextQuestion['last_tested_domain'];
                    $diagnostic->update(['adaptive_state' => json_encode($adaptiveState)]);
                }

                DiagnosticResponse::create([
                    'diagnostic_id' => $diagnostic->id,
                    'diagnostic_item_id' => $nextQuestion['question_id'],
                    'user_answer' => null,
                    'is_correct' => null,
                    'response_time_seconds' => null,
                ]);
            }
        }
    }

    private function showResults(Diagnostic $diagnostic)
    {
        $this->newLine();
        $this->info('🏁 Test Complete!');

        // Get the domain used for testing
        $responses = $diagnostic->responses()
            ->with('diagnosticItem.subtopic.topic.domain')
            ->get();

        $domainId = $responses->first()->diagnosticItem->subtopic->topic->domain->id ?? null;

        if ($domainId) {
            $adaptiveService = new AdaptiveDiagnosticService;
            $finalState = json_decode($diagnostic->adaptive_state, true);
            $proficiencyLevel = $adaptiveService->calculateFinalProficiencyLevel($domainId, $finalState);
            $label = $adaptiveService->getProficiencyLabel($proficiencyLevel);

            $this->info("Final Proficiency: {$proficiencyLevel} - {$label}");

            // Show bloom progression
            if (isset($finalState['domain_bloom_history'][$domainId])) {
                $bloomHistory = $finalState['domain_bloom_history'][$domainId];
                $answerHistory = $finalState['domain_history'][$domainId];

                $progression = '';
                $currentLevel = null;

                foreach ($bloomHistory as $index => $level) {
                    if ($currentLevel !== $level) {
                        if ($progression) {
                            $progression .= ' → ';
                        }
                        $progression .= "L{$level}";
                        $currentLevel = $level;
                    }
                    $progression .= $answerHistory[$index] ? '✓' : '✗';
                }

                $this->info("Actual Pattern: {$progression}");
            }
        }

        $this->newLine();
        $this->info('Run full analysis with:');
        $this->line("php artisan diagnostic:analyze {$diagnostic->id}");
    }
}
