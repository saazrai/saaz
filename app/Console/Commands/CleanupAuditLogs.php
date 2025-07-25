<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use OwenIt\Auditing\Models\Audit;

class CleanupAuditLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:cleanup 
                            {--days=90 : Number of days to keep audit logs}
                            {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old audit logs to maintain database performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $dryRun = $this->option('dry-run');

        $cutoffDate = Carbon::now()->subDays($days);

        $this->info("Cleaning up audit logs older than {$days} days (before {$cutoffDate->format('Y-m-d H:i:s')})");

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No records will be deleted');
        }

        // Count records to be deleted
        $count = Audit::where('created_at', '<', $cutoffDate)->count();

        if ($count === 0) {
            $this->info('No audit logs found to clean up.');

            return 0;
        }

        $this->info("Found {$count} audit records to clean up.");

        if (! $dryRun) {
            if (! $this->confirm("Are you sure you want to delete {$count} audit records?")) {
                $this->info('Cleanup cancelled.');

                return 0;
            }

            $this->info('Deleting audit records...');

            // Delete in chunks to avoid memory issues
            $deleted = 0;
            $chunkSize = 1000;

            while (true) {
                $chunk = Audit::where('created_at', '<', $cutoffDate)
                    ->limit($chunkSize)
                    ->get();

                if ($chunk->isEmpty()) {
                    break;
                }

                $chunkCount = $chunk->count();
                $chunk->each->delete();

                $deleted += $chunkCount;
                $this->info("Deleted {$chunkCount} records (Total: {$deleted}/{$count})");

                // Small delay to prevent overwhelming the database
                usleep(100000); // 0.1 second
            }

            $this->info("Successfully deleted {$deleted} audit records.");
        } else {
            $this->table(['Model', 'Count'], $this->getBreakdownByModel($cutoffDate));
        }

        return 0;
    }

    /**
     * Get breakdown of audit records by model type
     */
    protected function getBreakdownByModel(Carbon $cutoffDate): array
    {
        $breakdown = Audit::where('created_at', '<', $cutoffDate)
            ->selectRaw('auditable_type, COUNT(*) as count')
            ->groupBy('auditable_type')
            ->orderBy('count', 'desc')
            ->get();

        return $breakdown->map(function ($item) {
            return [
                'model' => class_basename($item->auditable_type),
                'count' => $item->count,
            ];
        })->toArray();
    }
}
