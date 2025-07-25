<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use Illuminate\Console\Command;

class ListDiagnostics extends Command
{
    protected $signature = 'diagnostic:list 
                          {--user= : Filter by user ID}
                          {--status= : Filter by status (in_progress, completed, paused)}
                          {--recent=10 : Number of recent diagnostics to show}
                          {--topics : Show topics and question counts instead of diagnostics}
                          {--domain= : Filter topics by domain ID or name}
                          {--phase= : Filter topics by phase (1-4)}
                          {--h|help : Show detailed help message}';

    protected $description = 'List diagnostics with basic statistics';

    public function handle()
    {
        // Check if user wants to see topics instead of diagnostics
        if ($this->option('topics')) {
            return $this->showTopics();
        }

        $query = Diagnostic::with(['user', 'responses']);

        // Apply filters
        if ($userId = $this->option('user')) {
            $query->where('user_id', $userId);
        }

        if ($status = $this->option('status')) {
            $query->where('status', $status);
        }

        $diagnostics = $query->orderBy('created_at', 'desc')
            ->limit($this->option('recent'))
            ->get();

        if ($diagnostics->isEmpty()) {
            $this->info('No diagnostics found.');

            return;
        }

        $this->info('Recent Diagnostics:');

        $headers = ['ID', 'User', 'Status', 'Questions', 'Score', 'Duration', 'Created'];

        $rows = $diagnostics->map(function ($diagnostic) {
            $duration = $diagnostic->total_duration_seconds
                ? gmdate('H:i:s', $diagnostic->total_duration_seconds)
                : 'N/A';

            return [
                $diagnostic->id,
                $diagnostic->user->name ?? 'Unknown',
                ucfirst($diagnostic->status),
                $diagnostic->responses->count(),
                $diagnostic->score ? round($diagnostic->score, 1).'%' : 'N/A',
                $duration,
                $diagnostic->created_at->format('Y-m-d H:i'),
            ];
        })->toArray();

        $this->table($headers, $rows);

        // Show summary statistics
        $this->newLine();
        $this->info('Summary Statistics:');

        $completed = $diagnostics->where('status', 'completed');
        if ($completed->count() > 0) {
            $avgQuestions = $completed->avg(fn ($d) => $d->responses->count());
            $avgScore = $completed->avg('score');

            $this->line('Average questions per completed diagnostic: '.round($avgQuestions));
            $this->line('Average score: '.round($avgScore, 1).'%');

            // Find diagnostics with unusually high question counts
            $highQuestionDiagnostics = $completed->filter(fn ($d) => $d->responses->count() > 80);
            if ($highQuestionDiagnostics->count() > 0) {
                $this->newLine();
                $this->warn('Diagnostics with >80 questions: '.$highQuestionDiagnostics->count());
                $this->line('IDs: '.$highQuestionDiagnostics->pluck('id')->join(', '));
                $this->line("Use 'php artisan diagnostic:analyze {id}' to investigate why.");
            }
        }
    }

    private function showTopics()
    {
        $domainId = $this->option('domain');
        $phaseId = $this->option('phase');

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

        } else {
            // Show all domains
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
        $this->showTopicWarnings($topicStats);

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

    private function showTopicWarnings($topicStats)
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

    private function showHelp()
    {
        $this->info('NAME');
        $this->line('  diagnostic:list - List diagnostic assessments with statistics');

        $this->newLine();
        $this->info('SYNOPSIS');
        $this->line('  php artisan diagnostic:list [options]');

        $this->newLine();
        $this->info('DESCRIPTION');
        $this->line('  Lists recent diagnostic assessments with basic statistics including:');
        $this->line('  - User name, status, question count, score, and duration');
        $this->line('  - Summary statistics for completed diagnostics');
        $this->line('  - Identifies diagnostics with unusually high question counts (>80)');

        $this->newLine();
        $this->info('OPTIONS');
        $this->line('  --user=<id>      Filter by user ID');
        $this->line('  --status=<type>  Filter by status (in_progress, completed, paused)');
        $this->line('  --recent=<n>     Number of recent diagnostics to show (default: 10)');
        $this->line('  --topics         Show topics and question counts instead of diagnostics');
        $this->line('  --domain=<id>    Filter topics by domain ID or name (use with --topics)');
        $this->line('  --phase=<n>      Filter topics by phase (1-4) (use with --topics)');
        $this->line('  -h, --help       Display this help message');

        $this->newLine();
        $this->info('EXAMPLES');
        $this->line('  # List 10 most recent diagnostics');
        $this->line('  php artisan diagnostic:list');

        $this->newLine();
        $this->line('  # List completed diagnostics for user ID 5');
        $this->line('  php artisan diagnostic:list --user=5 --status=completed');

        $this->newLine();
        $this->line('  # Show last 20 diagnostics');
        $this->line('  php artisan diagnostic:list --recent=20');

        $this->newLine();
        $this->line('  # Show all topics and question counts');
        $this->line('  php artisan diagnostic:list --topics');

        $this->newLine();
        $this->line('  # Show topics for a specific domain');
        $this->line('  php artisan diagnostic:list --topics --domain="General Security"');

        $this->newLine();
        $this->line('  # Show topics for Phase 1');
        $this->line('  php artisan diagnostic:list --topics --phase=1');
    }
}
