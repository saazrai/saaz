<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use Illuminate\Console\Command;

class DiagnosticPool extends Command
{
    protected $signature = 'diagnostic:pool 
                            {diagnostic? : Diagnostic ID to show pool stats for domains used}
                            {--phase= : Show pool stats for specific phase (1-4)}';

    protected $description = 'Show question pool statistics by domain and bloom level';

    public function handle()
    {
        $diagnosticId = $this->argument('diagnostic');
        $phaseId = $this->option('phase');
        $showAll = false;

        $this->info('=== QUESTION POOL STATISTICS ===');
        $this->newLine();

        // Determine which domains to show
        $domains = collect();

        if ($diagnosticId) {
            // Show domains from specific diagnostic
            $diagnostic = Diagnostic::with(['responses.diagnosticItem.subtopic.topic.domain'])
                ->find($diagnosticId);

            if (! $diagnostic) {
                $this->error("Diagnostic with ID {$diagnosticId} not found.");

                return 1;
            }

            $this->info("Showing pool statistics for domains used in Diagnostic #{$diagnosticId}");

            // Get unique domains from diagnostic
            $domainNames = $diagnostic->responses()
                ->with('diagnosticItem.subtopic.topic.domain')
                ->get()
                ->pluck('diagnosticItem.subtopic.topic.domain.name')
                ->filter()
                ->unique();

            $domains = DiagnosticDomain::whereIn('name', $domainNames)->get();

        } elseif ($phaseId) {
            // Show domains from specific phase
            $this->info("Showing pool statistics for Phase {$phaseId}");
            $domains = DiagnosticDomain::where('phase_id', $phaseId)->where('is_active', true)->get();

        } else {
            // Default: show all domains
            $this->info('Showing pool statistics for all 20 domains');
            $domains = DiagnosticDomain::where('is_active', true)->orderBy('phase_id')->orderBy('phase_order')->get();
            $showAll = true; // Set flag to group by phase
        }

        if ($domains->isEmpty()) {
            $this->warn('No domains found.');

            return 0;
        }

        // Calculate pool statistics
        $poolStats = [];
        $totalQuestions = 0;

        foreach ($domains as $domain) {
            $bloomDistribution = [];

            // Get question count for each bloom level
            for ($level = 1; $level <= 6; $level++) {
                $count = DiagnosticItem::where('status', 'published')
                    ->where('bloom_level', $level)
                    ->whereHas('subtopic.topic.domain', function ($query) use ($domain) {
                        $query->where('id', $domain->id);
                    })
                    ->count();

                if ($count > 0) {
                    $bloomDistribution[$level] = $count;
                }
            }

            // Calculate total questions in pool
            $totalInPool = array_sum($bloomDistribution);
            $totalQuestions += $totalInPool;

            $poolStats[] = [
                'id' => $domain->id,
                'domain' => $domain->name,
                'phase' => $domain->phase_id,
                'total_pool' => $totalInPool,
                'distribution' => $bloomDistribution,
            ];
        }

        // Group by phase if showing all
        if ($showAll) {
            $this->displayByPhase($poolStats);
        } else {
            $this->displayPoolTable($poolStats);
        }

        // Summary
        $this->newLine();
        $this->info('SUMMARY:');
        $this->line('Total domains: '.count($poolStats));
        $this->line('Total questions: '.$totalQuestions);
        $this->line('Average per domain: '.round($totalQuestions / count($poolStats), 1));

        // Show warnings
        $this->showWarnings($poolStats);

        return 0;
    }

    private function displayPoolTable($poolStats)
    {
        $this->table(
            ['ID', 'Domain', 'Total', 'L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'Status'],
            array_map(function ($stat) {
                $status = $this->getPoolStatus($stat);

                return [
                    $stat['id'],
                    substr($stat['domain'], 0, 30),
                    $stat['total_pool'],
                    $this->formatCount($stat['distribution'][1] ?? 0),
                    $this->formatCount($stat['distribution'][2] ?? 0),
                    $this->formatCount($stat['distribution'][3] ?? 0),
                    $this->formatCount($stat['distribution'][4] ?? 0),
                    $this->formatCount($stat['distribution'][5] ?? 0),
                    $this->formatCount($stat['distribution'][6] ?? 0),
                    $status,
                ];
            }, $poolStats)
        );
    }

    private function displayByPhase($poolStats)
    {
        // Group by phase
        $phases = collect($poolStats)->groupBy('phase');

        foreach ($phases as $phaseId => $phaseStats) {
            // Handle NULL phase_id (unassigned domains)
            if ($phaseId === null || $phaseId === '') {
                $this->info('Unassigned Domains (No Phase)');
            } else {
                $phase = \App\Models\DiagnosticPhase::find($phaseId);
                if ($phase) {
                    $this->info("Phase {$phaseId}: {$phase->name}");
                } else {
                    $this->info("Phase {$phaseId}: Unknown Phase");
                }
            }

            $this->table(
                ['ID', 'Domain', 'Total', 'L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'Status'],
                array_map(function ($stat) {
                    $status = $this->getPoolStatus($stat);

                    return [
                        $stat['id'],
                        substr($stat['domain'], 0, 30),
                        $stat['total_pool'],
                        $this->formatCount($stat['distribution'][1] ?? 0),
                        $this->formatCount($stat['distribution'][2] ?? 0),
                        $this->formatCount($stat['distribution'][3] ?? 0),
                        $this->formatCount($stat['distribution'][4] ?? 0),
                        $this->formatCount($stat['distribution'][5] ?? 0),
                        $this->formatCount($stat['distribution'][6] ?? 0),
                        $status,
                    ];
                }, $phaseStats->toArray())
            );

            $this->newLine();
        }
    }

    private function formatCount($count)
    {
        if ($count == 0) {
            return '-';
        }
        if ($count < 10) {
            return "<fg=red>{$count}</>";
        }
        if ($count < 15) {
            return "<fg=yellow>{$count}</>";
        }

        return "<fg=green>{$count}</>";
    }

    private function getPoolStatus($stat)
    {
        $lowLevels = 0;
        $missingLevels = 0;

        for ($level = 1; $level <= 6; $level++) {
            $count = $stat['distribution'][$level] ?? 0;
            if ($count == 0) {
                $missingLevels++;
            } elseif ($count < 10) {
                $lowLevels++;
            }
        }

        if ($missingLevels >= 3) {
            return '<fg=red>⚠️ Limited</>';
        } elseif ($lowLevels >= 3) {
            return '<fg=yellow>⚠️ Low</>';
        } elseif ($stat['total_pool'] < 30) {
            return '<fg=yellow>⚠️ Small Pool</>';
        }

        return '<fg=green>✓ Good</>';
    }

    private function showWarnings($poolStats)
    {
        $warnings = [];

        foreach ($poolStats as $stat) {
            $lowLevels = [];
            $missingLevels = [];

            for ($level = 1; $level <= 6; $level++) {
                $count = $stat['distribution'][$level] ?? 0;
                if ($count == 0) {
                    $missingLevels[] = "L{$level}";
                } elseif ($count < 10) {
                    $lowLevels[] = "L{$level}({$count})";
                }
            }

            $issues = [];
            if (! empty($missingLevels)) {
                $issues[] = 'Missing: '.implode(', ', $missingLevels);
            }
            if (! empty($lowLevels)) {
                $issues[] = 'Low (<10): '.implode(', ', $lowLevels);
            }

            if (! empty($issues)) {
                $warnings[] = "⚠️  {$stat['domain']}: ".implode(' | ', $issues);
            }
        }

        if (! empty($warnings)) {
            $this->newLine();
            $this->warn('DOMAINS WITH INSUFFICIENT QUESTIONS:');
            foreach ($warnings as $warning) {
                $this->line($warning);
            }

            $this->newLine();
            $this->info('Recommendation: Add more questions to levels with <15 questions for optimal adaptive testing.');
        }
    }
}
