<?php

namespace App\Console\Commands;

use App\Models\DiagnosticItem;
use App\Services\AdaptiveDiagnosticService;
use Illuminate\Console\Command;

class DiagnosticTestScenario extends Command
{
    protected $signature = 'diagnostic:test-scenario 
                            {scenario : Scenario to test (l5-regression, two-level-drop, question-selection, uncertain-zone)}';

    protected $description = 'Test specific diagnostic scenarios to identify bugs';

    private AdaptiveDiagnosticService $service;

    public function __construct(AdaptiveDiagnosticService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $scenario = $this->argument('scenario');
        
        switch ($scenario) {
            case 'l5-regression':
                $this->testL5Regression();
                break;
            case 'two-level-drop':
                $this->testTwoLevelDrop();
                break;
            case 'question-selection':
                $this->testQuestionSelection();
                break;
            case 'uncertain-zone':
                $this->testUncertainZone();
                break;
            default:
                $this->error("Unknown scenario: {$scenario}");
                return 1;
        }

        return 0;
    }

    private function testL5Regression()
    {
        $this->info('🧪 Testing L5 Regression Scenario');
        $this->info('Pattern: Advance to L5, then fail 2 questions');
        $this->newLine();

        $state = $this->service->initializeTest();
        $domainId = 2; // Information Security Governance
        
        // Get questions
        $l3Questions = DiagnosticItem::where('bloom_level', 3)
            ->whereHas('topic', fn($q) => $q->where('domain_id', $domainId))
            ->where('status', 'published')
            ->take(2)->get();
            
        $l4Questions = DiagnosticItem::where('bloom_level', 4)
            ->whereHas('topic', fn($q) => $q->where('domain_id', $domainId))
            ->where('status', 'published')
            ->take(2)->get();
            
        $l5Questions = DiagnosticItem::where('bloom_level', 5)
            ->whereHas('topic', fn($q) => $q->where('domain_id', $domainId))
            ->where('status', 'published')
            ->take(2)->get();

        // L3: 2/2 correct → advance to L4
        foreach ($l3Questions as $i => $item) {
            $state = $this->service->processAnswer($state, $item, true);
            $this->showState($state, $domainId, $i + 1, 'L3', true);
        }

        // L4: 2/2 correct → advance to L5
        foreach ($l4Questions as $i => $item) {
            $state = $this->service->processAnswer($state, $item, true);
            $this->showState($state, $domainId, $i + 3, 'L4', true);
        }

        // L5: 0/2 wrong → should regress to L4
        foreach ($l5Questions as $i => $item) {
            $state = $this->service->processAnswer($state, $item, false);
            $this->showState($state, $domainId, $i + 5, 'L5', false);
        }

        $this->newLine();
        $this->info('Expected: Regression from L5 to L4');
        $actualLevel = $state['domain_bloom_levels'][$domainId] ?? 'unknown';
        $this->info("Actual: Level {$actualLevel}");
        
        if ($actualLevel == 4) {
            $this->info('✅ PASS: Correct regression behavior');
        } else {
            $this->error("❌ FAIL: Expected L4, got L{$actualLevel}");
        }
    }

    private function testTwoLevelDrop()
    {
        $this->info('🧪 Testing Two-Level Drop Scenario');
        $this->info('Simulating the ISG case from bot output');
        $this->newLine();

        $state = $this->service->initializeTest();
        $domainId = 2; // Information Security Governance
        
        // Simulate the exact progression: 3✓ → 3✓ → 4✓ → 4✓ → 5✗ → 5✗
        $questions = [
            ['level' => 3, 'correct' => true],
            ['level' => 3, 'correct' => true],
            ['level' => 4, 'correct' => true],
            ['level' => 4, 'correct' => true],
            ['level' => 5, 'correct' => false],
            ['level' => 5, 'correct' => false],
        ];

        foreach ($questions as $i => $q) {
            $item = DiagnosticItem::where('bloom_level', $q['level'])
                ->whereHas('topic', fn($query) => $query->where('domain_id', $domainId))
                ->where('status', 'published')
                ->skip($i % 2) // Get different questions
                ->first();
                
            if (!$item) {
                $this->error("No L{$q['level']} question available");
                continue;
            }

            $state = $this->service->processAnswer($state, $item, $q['correct']);
            $this->showState($state, $domainId, $i + 1, "L{$q['level']}", $q['correct']);
        }

        $this->newLine();
        $finalLevel = $state['domain_bloom_levels'][$domainId] ?? 'unknown';
        $this->info("Final adaptive level: L{$finalLevel}");
        
        // Check if ceiling was found
        if (isset($state['domain_ceiling_found'][$domainId])) {
            $this->info("Ceiling found at: L{$state['domain_ceiling_found'][$domainId]}");
        }
    }

    private function testQuestionSelection()
    {
        $this->info('🧪 Testing Question Selection Logic');
        $this->newLine();

        $state = $this->service->initializeTest();
        $existingIds = [];
        
        // Test various scenarios
        $scenarios = [
            'Empty state (first question)',
            'After L3 success',
            'At L4 ready for L5',
            'At L5 needing confirmation'
        ];

        foreach ($scenarios as $i => $scenario) {
            $this->info("Scenario {$i}: {$scenario}");
            
            // Adjust state for scenario
            switch ($i) {
                case 1: // After L3 success
                    $state['domain_bloom_levels'][1] = 3;
                    $state['domain_history'][1] = [true, true];
                    $state['domain_attempt_questions'][1] = [3 => 2];
                    break;
                case 2: // At L4 ready for L5
                    $state['domain_bloom_levels'][2] = 4;
                    $state['domain_history'][2] = [true, true, true, true];
                    $state['domain_bloom_history'][2] = [3, 3, 4, 4];
                    $state['domain_attempt_questions'][2] = [4 => 2];
                    break;
                case 3: // At L5 needing confirmation
                    $state['domain_bloom_levels'][3] = 5;
                    $state['domain_history'][3] = [true, true, true, true, true];
                    $state['domain_attempt_questions'][3] = [5 => 1];
                    break;
            }
            
            $result = $this->service->selectNextQuestion($state, $existingIds, 1);
            
            if ($result && !isset($result['stop_domain'])) {
                $this->line("  Selected: Domain {$result['domain_id']}, Target L{$result['target_bloom_level']}");
                $existingIds[] = $result['question_id'];
            } else {
                $this->line("  No question selected");
            }
            
            $this->newLine();
        }
    }

    private function showState($state, $domainId, $questionNum, $questionLevel, $correct)
    {
        $adaptiveLevel = $state['domain_bloom_levels'][$domainId] ?? 3;
        $symbol = $correct ? '✓' : '✗';
        $attemptQuestions = $state['domain_attempt_questions'][$domainId][$adaptiveLevel] ?? 0;
        
        $this->line("Q{$questionNum}: {$questionLevel} {$symbol} → Adaptive L{$adaptiveLevel} (attempt: {$attemptQuestions})");
        
        // Show if level changed
        if ($questionNum > 1) {
            $history = $state['domain_bloom_history'][$domainId] ?? [];
            if (count($history) >= 2) {
                $prevLevel = $history[count($history) - 2];
                if ($prevLevel != $adaptiveLevel) {
                    $change = $adaptiveLevel > $prevLevel ? '↑' : '↓';
                    $this->info("  LEVEL CHANGE: L{$prevLevel} → L{$adaptiveLevel} {$change}");
                }
            }
        }
    }
    
    private function testUncertainZone()
    {
        $this->info('🧪 Testing Uncertain Zone Scenario');
        $this->info('Pattern: Domain at L4 with 50% performance (1/2) should get 3rd question');
        $this->newLine();

        $state = $this->service->initializeTest();
        $domainId = 3; // Legal, Regulatory & Compliance
        
        // L3: 2/2 correct → advance to L4
        $l3Questions = DiagnosticItem::where('bloom_level', 3)
            ->whereHas('topic', fn($q) => $q->where('domain_id', $domainId))
            ->where('status', 'published')
            ->take(2)->get();
            
        foreach ($l3Questions as $i => $item) {
            $state = $this->service->processAnswer($state, $item, true);
            $this->showState($state, $domainId, $i + 1, 'L3', true);
        }

        // L4: 1/2 (50%) - uncertain zone
        $l4Questions = DiagnosticItem::where('bloom_level', 4)
            ->whereHas('topic', fn($q) => $q->where('domain_id', $domainId))
            ->where('status', 'published')
            ->take(3)->get();
            
        // First L4: correct
        $state = $this->service->processAnswer($state, $l4Questions[0], true);
        $this->showState($state, $domainId, 3, 'L4', true);
        
        // Second L4: incorrect (now 50%)
        $state = $this->service->processAnswer($state, $l4Questions[1], false);
        $this->showState($state, $domainId, 4, 'L4', false);
        
        $this->newLine();
        $this->info('Performance at L4: 50% (1/2) - Uncertain Zone');
        
        // Check if domain should continue
        $questionsInDomain = 4;
        $shouldContinue = $this->service->shouldContinueDomain($domainId, $questionsInDomain, $state);
        
        $this->info("Should continue testing? " . ($shouldContinue ? 'YES' : 'NO'));
        
        if ($shouldContinue) {
            $this->info('✅ PASS: Domain correctly continues testing in uncertain zone');
            
            // Test the 3rd question
            $state = $this->service->processAnswer($state, $l4Questions[2], true);
            $this->showState($state, $domainId, 5, 'L4', true);
            
            $this->info('After 3rd question: Performance = 66.7% (2/3)');
            $finalLevel = $state['domain_bloom_levels'][$domainId] ?? 'unknown';
            
            if ($finalLevel == 4) {
                $this->info('✅ Domain stays at L4 (needs >66.67% to advance)');
            } else if ($finalLevel == 5) {
                $this->info('✅ Domain advances to L5 (achieved 66.7% ≥ 66.67%)');
            }
        } else {
            $this->error('❌ FAIL: Domain stopped testing despite uncertain performance');
        }
    }
}