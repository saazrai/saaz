<?php

namespace App\Console\Commands;

use App\Models\DiagnosticItem;
use App\Services\AdaptiveDiagnosticService;
use Illuminate\Console\Command;

class TestBloomProgression extends Command
{
    protected $signature = 'diagnostic:test-bloom 
                            {--domain=1 : Domain ID to test}
                            {--pattern=CCCWW : Answer pattern (C=correct, W=wrong)}';

    protected $description = 'Test bloom level progression with specific answer patterns';

    public function handle()
    {
        $domainId = $this->option('domain');
        $pattern = str_split(strtoupper($this->option('pattern')));

        $this->info('🧪 Testing Bloom Progression');
        $this->info("Domain ID: {$domainId}");
        $this->info('Pattern: '.implode('-', $pattern));
        $this->newLine();

        // Initialize adaptive service
        $adaptiveService = new AdaptiveDiagnosticService;
        $state = $adaptiveService->initializeTest();

        // Simulate answers according to pattern
        $bloomLevel = 3; // Start at Apply
        $results = [];

        foreach ($pattern as $index => $answer) {
            $isCorrect = $answer === 'C';

            // Create mock item
            $mockItem = new DiagnosticItem;
            $mockItem->bloom_level = $bloomLevel;
            $mockItem->setRelation('topic', (object) ['domain_id' => $domainId]);

            // Process answer
            $stateBefore = $state;
            $state = $adaptiveService->processAnswer($state, $mockItem, $isCorrect);

            // Get new bloom level
            $newBloomLevel = $adaptiveService->getDomainBloomLevel($state, $domainId);

            // Record result
            $results[] = [
                'question' => $index + 1,
                'answer' => $isCorrect ? '✓' : '✗',
                'bloom_before' => $bloomLevel,
                'bloom_after' => $newBloomLevel,
                'streak_correct' => $state['domain_streaks'][$domainId]['correct'] ?? 0,
                'streak_incorrect' => $state['domain_streaks'][$domainId]['incorrect'] ?? 0,
            ];

            // Display result
            $change = '';
            if ($newBloomLevel > $bloomLevel) {
                $change = ' ↑';
                $this->info("Q{$results[count($results) - 1]['question']}: L{$bloomLevel} → L{$newBloomLevel}{$change} (Correct: {$results[count($results) - 1]['streak_correct']}, Incorrect: {$results[count($results) - 1]['streak_incorrect']})");
            } elseif ($newBloomLevel < $bloomLevel) {
                $change = ' ↓';
                $this->error("Q{$results[count($results) - 1]['question']}: L{$bloomLevel} → L{$newBloomLevel}{$change} (Correct: {$results[count($results) - 1]['streak_correct']}, Incorrect: {$results[count($results) - 1]['streak_incorrect']})");
            } else {
                $this->line("Q{$results[count($results) - 1]['question']}: L{$bloomLevel} → L{$newBloomLevel} (Correct: {$results[count($results) - 1]['streak_correct']}, Incorrect: {$results[count($results) - 1]['streak_incorrect']})");
            }

            $bloomLevel = $newBloomLevel;
        }

        // Summary
        $this->newLine();
        $this->info('Summary:');
        $this->table(
            ['Q#', 'Answer', 'Level Before', 'Level After', 'Change', 'Correct Streak', 'Wrong Streak'],
            array_map(function ($r) {
                $change = '';
                if ($r['bloom_after'] > $r['bloom_before']) {
                    $change = '↑ (+'.($r['bloom_after'] - $r['bloom_before']).')';
                } elseif ($r['bloom_after'] < $r['bloom_before']) {
                    $change = '↓ (-'.($r['bloom_before'] - $r['bloom_after']).')';
                } else {
                    $change = '—';
                }

                return [
                    $r['question'],
                    $r['answer'],
                    $r['bloom_before'],
                    $r['bloom_after'],
                    $change,
                    $r['streak_correct'],
                    $r['streak_incorrect'],
                ];
            }, $results)
        );

        // Test specific scenarios
        $this->newLine();
        $this->info('Key Rules Verification:');

        // Check for 3 consecutive correct → level up
        $foundLevelUp = false;
        for ($i = 2; $i < count($results); $i++) {
            if ($results[$i - 2]['answer'] === '✓' &&
                $results[$i - 1]['answer'] === '✓' &&
                $results[$i]['answer'] === '✓' &&
                $results[$i]['bloom_after'] > $results[$i]['bloom_before']) {
                $foundLevelUp = true;
                $this->info('✅ 3 consecutive correct answers caused level UP (Q'.($i - 2).'-'.($i + 1).')');
            }
        }
        if (! $foundLevelUp && strpos(implode('', $pattern), 'CCC') !== false) {
            $this->error('❌ 3 consecutive correct answers did NOT cause level up!');
        }

        // Check for 2 consecutive wrong → level down
        $foundLevelDown = false;
        for ($i = 1; $i < count($results); $i++) {
            if ($results[$i - 1]['answer'] === '✗' &&
                $results[$i]['answer'] === '✗' &&
                $results[$i]['bloom_after'] < $results[$i]['bloom_before']) {
                $foundLevelDown = true;
                $this->info('✅ 2 consecutive wrong answers caused level DOWN (Q'.($i).'-'.($i + 1).')');
            }
        }
        if (! $foundLevelDown && strpos(implode('', $pattern), 'WW') !== false) {
            $this->error('❌ 2 consecutive wrong answers did NOT cause level down!');
        }

        // Check for single wrong not causing level down
        for ($i = 0; $i < count($results); $i++) {
            if ($results[$i]['answer'] === '✗' &&
                ($i === 0 || $results[$i - 1]['answer'] === '✓') &&
                $results[$i]['bloom_after'] < $results[$i]['bloom_before']) {
                $this->error('❌ Single wrong answer caused level down at Q'.($i + 1).'!');
            }
        }

        return 0;
    }
}
