<?php

namespace App\Console\Commands;

use App\Models\SampleQuizAssessment;
use Illuminate\Console\Command;

class CleanupAbandonedSampleQuizzes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:cleanup-abandoned 
                           {--hours=24 : Hours after which incomplete assessments are considered abandoned}
                           {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up abandoned sample quiz assessments that are older than specified hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = (int) $this->option('hours');
        $isDryRun = $this->option('dry-run');
        
        $cutoffTime = now()->subHours($hours);
        
        $this->info("Looking for abandoned sample quiz assessments older than {$hours} hours (before {$cutoffTime})...");
        
        // Find abandoned assessments
        $abandonedQuery = SampleQuizAssessment::where('status', 'in_progress')
            ->where('created_at', '<', $cutoffTime);
            
        $count = $abandonedQuery->count();
        
        if ($count === 0) {
            $this->info('No abandoned assessments found.');
            return 0;
        }
        
        if ($isDryRun) {
            $this->info("DRY RUN: Would delete {$count} abandoned assessments:");
            
            $abandonedQuery->orderBy('created_at')
                ->get(['id', 'session_id', 'created_at'])
                ->each(function ($assessment) {
                    $this->line("  - ID: {$assessment->id}, Session: {$assessment->session_id}, Created: {$assessment->created_at}");
                });
                
            $this->warn('Run without --dry-run to actually delete these assessments.');
            return 0;
        }
        
        if (!$this->confirm("Are you sure you want to delete {$count} abandoned assessments?")) {
            $this->info('Cleanup cancelled.');
            return 0;
        }
        
        // Delete the abandoned assessments (cascades to responses)
        $deleted = $abandonedQuery->delete();
        
        $this->info("Successfully cleaned up {$deleted} abandoned sample quiz assessments.");
        
        // Show remaining stats
        $totalRemaining = SampleQuizAssessment::count();
        $completedCount = SampleQuizAssessment::where('status', 'completed')->count();
        $inProgressCount = SampleQuizAssessment::where('status', 'in_progress')->count();
        
        $this->info("Remaining assessments: {$totalRemaining} total ({$completedCount} completed, {$inProgressCount} in progress)");
        
        return 0;
    }
}
