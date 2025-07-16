<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use Illuminate\Console\Command;

class ListDiagnostics extends Command
{
    protected $signature = 'diagnostic:list 
                          {--user= : Filter by user ID}
                          {--status= : Filter by status (in_progress, completed, paused)}
                          {--recent=10 : Number of recent diagnostics to show}
                          {--h|help : Show detailed help message}';

    protected $description = 'List diagnostics with basic statistics';

    public function handle()
    {
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
                ? gmdate("H:i:s", $diagnostic->total_duration_seconds)
                : 'N/A';
                
            return [
                $diagnostic->id,
                $diagnostic->user->name ?? 'Unknown',
                ucfirst($diagnostic->status),
                $diagnostic->responses->count(),
                $diagnostic->score ? round($diagnostic->score, 1) . '%' : 'N/A',
                $duration,
                $diagnostic->created_at->format('Y-m-d H:i')
            ];
        })->toArray();

        $this->table($headers, $rows);

        // Show summary statistics
        $this->newLine();
        $this->info('Summary Statistics:');
        
        $completed = $diagnostics->where('status', 'completed');
        if ($completed->count() > 0) {
            $avgQuestions = $completed->avg(fn($d) => $d->responses->count());
            $avgScore = $completed->avg('score');
            
            $this->line("Average questions per completed diagnostic: " . round($avgQuestions));
            $this->line("Average score: " . round($avgScore, 1) . "%");
            
            // Find diagnostics with unusually high question counts
            $highQuestionDiagnostics = $completed->filter(fn($d) => $d->responses->count() > 80);
            if ($highQuestionDiagnostics->count() > 0) {
                $this->newLine();
                $this->warn("Diagnostics with >80 questions: " . $highQuestionDiagnostics->count());
                $this->line("IDs: " . $highQuestionDiagnostics->pluck('id')->join(', '));
                $this->line("Use 'php artisan diagnostic:analyze {id}' to investigate why.");
            }
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
    }
}