<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use App\Services\AdaptiveDiagnosticService;
use Illuminate\Console\Command;

class AnalyzeDiagnosticAdaptive extends Command
{
    protected $signature = 'diagnostic:analyze-adaptive {diagnostic : Diagnostic ID}';

    protected $description = 'Analyze diagnostic showing true adaptive state progression';

    public function handle()
    {
        $diagnosticId = $this->argument('diagnostic');
        $diagnostic = Diagnostic::with(['user', 'phase', 'responses.diagnosticItem.subtopic.topic.domain'])
            ->find($diagnosticId);

        if (! $diagnostic) {
            $this->error("Diagnostic with ID {$diagnosticId} not found.");

            return 1;
        }

        $this->info('=== ADAPTIVE STATE ANALYSIS ===');

        // Recreate the adaptive progression
        $adaptiveService = new AdaptiveDiagnosticService;
        $state = $adaptiveService->initializeTest();

        $responses = $diagnostic->responses()
            ->whereNotNull('user_answer')
            ->with('diagnosticItem.subtopic.topic.domain')
            ->orderBy('created_at')
            ->get();

        $domainProgressions = [];

        foreach ($responses as $index => $response) {
            $item = $response->diagnosticItem;
            if (! $item || ! $item->topic || ! $item->topic->domain) {
                continue;
            }

            $domainId = $item->topic->domain_id;
            $domainName = $item->topic->domain->name;
            $questionBloomLevel = $item->bloom_level;
            $isCorrect = $response->is_correct;

            // Get domain bloom level BEFORE processing
            $bloomBefore = $adaptiveService->getDomainBloomLevel($state, $domainId);

            // Process the answer
            $state = $adaptiveService->processAnswer($state, $item, $isCorrect);

            // Get domain bloom level AFTER processing
            $bloomAfter = $adaptiveService->getDomainBloomLevel($state, $domainId);

            // Track progression
            if (! isset($domainProgressions[$domainName])) {
                $domainProgressions[$domainName] = [];
            }

            $domainProgressions[$domainName][] = [
                'question_num' => $index + 1,
                'question_bloom' => $questionBloomLevel,
                'domain_bloom_before' => $bloomBefore,
                'domain_bloom_after' => $bloomAfter,
                'correct' => $isCorrect,
                'streak_correct' => $state['domain_streaks'][$domainId]['correct'] ?? 0,
                'streak_incorrect' => $state['domain_streaks'][$domainId]['incorrect'] ?? 0,
            ];
        }

        // Display results
        $this->info("\nDOMAIN ADAPTIVE PROGRESSIONS:\n");

        foreach ($domainProgressions as $domain => $progressions) {
            $this->line("<fg=cyan;options=bold>{$domain}:</>");

            // Build TWO progression strings: adaptive state and actual questions
            $adaptiveParts = [];
            $questionParts = [];

            foreach ($progressions as $prog) {
                // Adaptive state progression
                $adaptiveLevel = $prog['domain_bloom_after'];
                $adaptiveChange = '';
                if ($prog['domain_bloom_before'] != $prog['domain_bloom_after']) {
                    $adaptiveChange = $prog['domain_bloom_after'] > $prog['domain_bloom_before'] ? '↑' : '↓';
                }
                $adaptiveParts[] = $adaptiveLevel.$adaptiveChange;

                // Actual question progression
                $questionLevel = $prog['question_bloom'];
                $icon = $prog['correct'] ? '✓' : '✗';
                $color = $prog['correct'] ? 'green' : 'red';
                $questionParts[] = "<fg={$color}>{$questionLevel}{$icon}</>";
            }

            $this->line('  Questions: '.implode(' → ', $questionParts));
            $this->line('  Adaptive State: '.implode(' → ', $adaptiveParts).' (internal bloom tracking)');

            // Summary
            $correctCount = count(array_filter($progressions, fn ($p) => $p['correct']));
            $totalCount = count($progressions);
            $accuracy = round(($correctCount / $totalCount) * 100, 1);
            $this->line("  Summary: {$totalCount} questions, {$accuracy}% accuracy");
            $this->newLine();
        }

        // Show detailed table
        $this->info('DETAILED PROGRESSION TABLE:');

        foreach ($domainProgressions as $domain => $progressions) {
            $this->newLine();
            $this->line("<fg=cyan;options=bold>{$domain}:</>");

            $headers = ['Q#', 'Q-Bloom', 'D-Before', 'D-After', 'Result', 'C-Streak', 'W-Streak', 'Change'];
            $rows = array_map(function ($p) {
                $change = '';
                if ($p['domain_bloom_after'] > $p['domain_bloom_before']) {
                    $change = '↑ UP';
                } elseif ($p['domain_bloom_after'] < $p['domain_bloom_before']) {
                    $change = '↓ DOWN';
                }

                return [
                    $p['question_num'],
                    $p['question_bloom'],
                    $p['domain_bloom_before'],
                    $p['domain_bloom_after'],
                    $p['correct'] ? '✓' : '✗',
                    $p['streak_correct'],
                    $p['streak_incorrect'],
                    $change,
                ];
            }, $progressions);

            $this->table($headers, $rows);
        }

        return 0;
    }
}
