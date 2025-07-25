<?php

namespace App\Console\Commands;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use Illuminate\Console\Command;

class DiagnosticTopics extends Command
{
    protected $signature = 'diagnostic:topics 
                            {domain? : Domain ID or name to show topics for}
                            {--phase= : Show topics for specific phase (1-4)}
                            {--domain= : Filter by domain ID or name}
                            {--all : Show all domains and topics}';

    protected $description = 'Show diagnostic topics with question counts by domain';

    public function handle()
    {
        $domainId = $this->argument('domain');
        $phaseId = $this->option('phase');
        $showAll = $this->option('all');

        $this->info('=== DIAGNOSTIC TOPICS AND QUESTIONS ===');
        $this->newLine();

        // Determine which domains to show
        $domains = collect();

        if ($domainId || $this->option('domain')) {
            // Show topics from specific domain
            $searchTerm = $domainId ?: $this->option('domain');
            $domainQuery = DiagnosticDomain::query();
            if (is_numeric($searchTerm)) {
                $domainQuery->where('id', $searchTerm);
            } else {
                $domainQuery->where('name', 'ilike', "%{$searchTerm}%");
            }
            $domain = $domainQuery->first();

            if (! $domain) {
                $this->error("Domain with ID or name '{$searchTerm}' not found.");

                return 1;
            }

            $this->info("Showing topics for domain: {$domain->name}");
            $domains = collect([$domain]);

        } elseif ($phaseId) {
            // Show topics from specific phase
            $this->info("Showing topics for Phase {$phaseId}");
            $domains = DiagnosticDomain::where('phase_id', $phaseId)
                ->where('is_active', true)
                ->orderBy('phase_order')
                ->get();

        } elseif ($showAll) {
            // Show all domains
            $this->info('Showing all domains and topics');
            $domains = DiagnosticDomain::where('is_active', true)
                ->orderBy('phase_id')
                ->orderBy('phase_order')
                ->get();
        } else {
            // Default: show all domains
            $this->info('Showing all domains and topics');
            $domains = DiagnosticDomain::where('is_active', true)
                ->orderBy('phase_id')
                ->orderBy('phase_order')
                ->get();
        }

        if ($domains->isEmpty()) {
            $this->warn('No domains found.');

            return 0;
        }

        // Calculate topic statistics
        $topicStats = [];
        $totalQuestions = 0;
        $totalTopics = 0;

        foreach ($domains as $domain) {
            $domainTopics = DiagnosticTopic::where('domain_id', $domain->id)
                ->withCount(['items' => function ($query) {
                    $query->where('status', 'published');
                }])
                ->orderBy('name')
                ->get();

            foreach ($domainTopics as $topic) {
                $topicStats[] = [
                    'domain_id' => $domain->id,
                    'domain_name' => $domain->name,
                    'phase' => $domain->phase_id,
                    'topic_id' => $topic->id,
                    'topic_name' => $topic->name,
                    'question_count' => $topic->items_count,
                ];

                $totalQuestions += $topic->items_count;
                $totalTopics++;
            }
        }

        // Display the table
        $this->displayTopicsTable($topicStats);

        // Summary
        $this->newLine();
        $this->info('SUMMARY:');
        $this->line('Total domains: '.$domains->count());
        $this->line('Total topics: '.$totalTopics);
        $this->line('Total questions: '.$totalQuestions);
        $this->line('Average questions per topic: '.round($totalQuestions / max($totalTopics, 1), 1));

        // Show warnings for topics with insufficient questions
        $this->showWarnings($topicStats);

        return 0;
    }

    private function displayTopicsTable($topicStats)
    {
        // Group topics by domain
        $domains = collect($topicStats)->groupBy('domain_id');

        // Find the maximum number of topics across all domains
        $maxTopics = $domains->map->count()->max();

        // Build headers
        $headers = ['ID', 'Domain', 'Total'];
        for ($i = 1; $i <= $maxTopics; $i++) {
            $headers[] = "T{$i}";
        }

        // Build rows
        $rows = [];
        foreach ($domains as $domainId => $domainTopics) {
            $domainName = $domainTopics->first()['domain_name'];
            $totalQuestions = $domainTopics->sum('question_count');

            $row = [
                $domainId,
                substr($domainName, 0, 30),
                $this->formatCount($totalQuestions),
            ];

            // Add topic question counts
            foreach ($domainTopics as $topic) {
                $row[] = $this->formatCount($topic['question_count']);
            }

            // Pad with empty cells if needed
            while (count($row) < count($headers)) {
                $row[] = '-';
            }

            $rows[] = $row;
        }

        $this->table($headers, $rows);
    }

    private function formatCount($count)
    {
        if ($count == 0) {
            return '<fg=red>0</>';
        }
        if ($count < 5) {
            return "<fg=red>{$count}</>";
        }
        if ($count < 10) {
            return "<fg=yellow>{$count}</>";
        }

        return "<fg=green>{$count}</>";
    }

    private function getTopicStatus($count)
    {
        if ($count == 0) {
            return '<fg=red>⚠️ Empty</>';
        } elseif ($count < 5) {
            return '<fg=red>⚠️ Very Low</>';
        } elseif ($count < 10) {
            return '<fg=yellow>⚠️ Low</>';
        } elseif ($count < 20) {
            return '<fg=yellow>⚠️ Moderate</>';
        } else {
            return '<fg=green>✓ Good</>';
        }
    }

    private function showWarnings($topicStats)
    {
        $warnings = [];

        foreach ($topicStats as $stat) {
            if ($stat['question_count'] < 10) {
                $warnings[] = "⚠️  {$stat['domain_name']} > {$stat['topic_name']}: {$stat['question_count']} questions";
            }
        }

        if (! empty($warnings)) {
            $this->newLine();
            $this->warn('TOPICS WITH INSUFFICIENT QUESTIONS (<10):');
            foreach ($warnings as $warning) {
                $this->line($warning);
            }

            $this->newLine();
            $this->info('Recommendation: Add more questions to topics with <10 questions for optimal adaptive testing.');
        }
    }
}
