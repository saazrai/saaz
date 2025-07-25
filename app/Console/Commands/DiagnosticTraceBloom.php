<?php

namespace App\Console\Commands;

use App\Models\DiagnosticItem;
use App\Services\AdaptiveDiagnosticService;
use Illuminate\Console\Command;

class DiagnosticTraceBloom extends Command
{
    protected $signature = 'diagnostic:trace-bloom 
                            {--domain=1 : Domain ID to test}
                            {--pattern=CCWCW : Answer pattern (C=correct, W=wrong)}';

    protected $description = 'Trace bloom level progression with detailed debugging';

    private AdaptiveDiagnosticService $service;

    public function __construct(AdaptiveDiagnosticService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $domainId = (int) $this->option('domain');
        $pattern = str_split(strtoupper($this->option('pattern')));

        $this->info("🔍 Tracing Bloom Progression for Domain $domainId");
        $this->info('Pattern: '.implode('-', $pattern));
        $this->newLine();

        // Initialize state
        $state = $this->service->initializeTest();

        // Get questions for the domain at various levels
        $questionsByLevel = [];
        for ($level = 1; $level <= 5; $level++) {
            $questions = DiagnosticItem::whereHas('topic', function ($q) use ($domainId) {
                $q->where('domain_id', $domainId);
            })
                ->where('bloom_level', $level)
                ->where('status', 'published')
                ->get();
            $questionsByLevel[$level] = $questions;
            $this->line("L$level questions available: ".$questions->count());
        }
        $this->newLine();

        // Process each answer
        foreach ($pattern as $index => $answer) {
            $questionNum = $index + 1;
            $isCorrect = $answer === 'C';

            // Get current bloom level
            $currentBloom = $state['domain_bloom_levels'][$domainId] ?? 3;

            // Find a question at the appropriate level
            $item = $questionsByLevel[$currentBloom]->shift();
            if (! $item && $currentBloom < 5) {
                // Try higher level
                $item = $questionsByLevel[$currentBloom + 1]->shift();
            }
            if (! $item && $currentBloom > 1) {
                // Try lower level
                $item = $questionsByLevel[$currentBloom - 1]->shift();
            }

            if (! $item) {
                $this->error('No questions available!');
                break;
            }

            $this->info("Question $questionNum:");
            $this->line("  Adaptive Level: L$currentBloom");
            $this->line("  Question Level: L{$item->bloom_level}");
            $this->line('  Answer: '.($isCorrect ? '✓ Correct' : '✗ Wrong'));

            // Show pre-state
            $this->line('  Pre-State:');
            $this->showDomainState($state, $domainId);

            // Process answer
            $state = $this->service->processAnswer($state, $item, $isCorrect);

            // Show post-state
            $newBloom = $state['domain_bloom_levels'][$domainId];
            $this->line('  Post-State:');
            $this->showDomainState($state, $domainId);

            if ($newBloom != $currentBloom) {
                $change = $newBloom > $currentBloom ? '↑' : '↓';
                $this->warn("  LEVEL CHANGE: L$currentBloom → L$newBloom $change");
            }

            $this->newLine();
        }

        // Final proficiency
        $proficiency = $this->service->calculateFinalProficiencyLevel($domainId, $state);
        $label = $this->service->getProficiencyLabel($proficiency);

        $this->info("Final Proficiency: $proficiency - $label");

        // Show final state details
        $this->newLine();
        $this->info('Final State Analysis:');
        $this->showDetailedState($state, $domainId);
    }

    private function showDomainState($state, $domainId)
    {
        $bloom = $state['domain_bloom_levels'][$domainId] ?? 3;
        $history = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];
        $attempt = $state['domain_attempt_questions'][$domainId][$bloom] ?? 0;

        $this->line("    - Bloom Level: L$bloom");
        $this->line("    - Questions at attempt: $attempt");
        $this->line('    - Total history: '.count($history));

        // Calculate performance at current level
        if ($attempt >= 2) {
            $correct = 0;
            $start = count($history) - $attempt;
            for ($i = $start; $i < count($history); $i++) {
                if ($history[$i]) {
                    $correct++;
                }
            }
            $accuracy = ($correct / $attempt) * 100;
            $this->line("    - Current attempt accuracy: $correct/$attempt = ".round($accuracy, 1).'%');

            // Show thresholds
            $advanceThreshold = \App\Services\AdaptiveDiagnosticService::BLOOM_ADVANCE_THRESHOLDS[$bloom] ?? 0;
            $regressThreshold = \App\Services\AdaptiveDiagnosticService::BLOOM_REGRESS_THRESHOLDS[$bloom] ?? 0;
            $this->line('    - Advance threshold: '.($advanceThreshold * 100).'%');
            $this->line('    - Regress threshold: '.($regressThreshold * 100).'%');
        }
    }

    private function showDetailedState($state, $domainId)
    {
        $history = $state['domain_history'][$domainId] ?? [];
        $bloomHistory = $state['domain_bloom_history'][$domainId] ?? [];

        $this->table(
            ['Q#', 'Question Level', 'Correct', 'Adaptive Level'],
            array_map(function ($i) use ($history, $bloomHistory) {
                return [
                    $i + 1,
                    'L'.($bloomHistory[$i] ?? '?'),
                    $history[$i] ? '✓' : '✗',
                    'L'.$this->getAdaptiveLevelAtQuestion($i, $bloomHistory, $history),
                ];
            }, range(0, count($history) - 1))
        );

        // Show questions by bloom level
        $this->newLine();
        $this->info('Questions by Bloom Level:');
        $questionsByBloom = [];
        foreach ($bloomHistory as $i => $level) {
            if (! isset($questionsByBloom[$level])) {
                $questionsByBloom[$level] = ['correct' => 0, 'total' => 0];
            }
            $questionsByBloom[$level]['total']++;
            if ($history[$i]) {
                $questionsByBloom[$level]['correct']++;
            }
        }

        foreach ($questionsByBloom as $level => $stats) {
            $accuracy = ($stats['correct'] / $stats['total']) * 100;
            $this->line("  L$level: {$stats['correct']}/{$stats['total']} = ".round($accuracy, 1).'%');
        }
    }

    private function getAdaptiveLevelAtQuestion($index, $bloomHistory, $history)
    {
        // Reconstruct what the adaptive level was at each question
        $adaptiveLevel = 3; // Start at L3

        for ($i = 0; $i <= $index; $i++) {
            // This is simplified - would need full state tracking for accuracy
            // For now, just return the question's bloom level as approximation
            $adaptiveLevel = $bloomHistory[$i] ?? 3;
        }

        return $adaptiveLevel;
    }
}
