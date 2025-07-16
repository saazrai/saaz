<?php

namespace App\Console\Commands;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticDomain;
use Illuminate\Console\Command;

class DebugQuestionSelection extends Command
{
    protected $signature = 'diagnostic:debug-questions 
                            {domain : Domain ID}
                            {bloom : Target bloom level}
                            {--exclude= : Comma-separated list of question IDs to exclude}';

    protected $description = 'Debug question selection logic';

    public function handle()
    {
        $domainId = $this->argument('domain');
        $targetBloom = $this->argument('bloom');
        $excludeIds = $this->option('exclude') ? explode(',', $this->option('exclude')) : [];

        $domain = DiagnosticDomain::find($domainId);
        if (!$domain) {
            $this->error("Domain ID {$domainId} not found");
            return 1;
        }

        $this->info("Debugging question selection for:");
        $this->info("Domain: {$domain->name} (ID: {$domainId})");
        $this->info("Target Bloom Level: {$targetBloom}");
        $this->info("Excluded IDs: " . (empty($excludeIds) ? 'None' : implode(', ', $excludeIds)));
        $this->newLine();

        // Try exact bloom level
        $exactQuery = DiagnosticItem::where('status', 'published')
            ->whereNotIn('id', $excludeIds)
            ->where('bloom_level', $targetBloom)
            ->whereHas('topic.domain', function($query) use ($domainId) {
                $query->where('id', $domainId);
            });

        $exactCount = $exactQuery->count();
        $this->info("Questions at exact bloom level {$targetBloom}: {$exactCount}");

        if ($exactCount > 0) {
            $this->info("Sample questions:");
            $exactQuery->take(5)->get()->each(function($item) {
                $this->line("  - ID: {$item->id}, Topic: {$item->topic->name}");
            });
        }

        // Check all bloom levels for this domain
        $this->newLine();
        $this->info("Question distribution for this domain:");
        
        for ($level = 1; $level <= 6; $level++) {
            $count = DiagnosticItem::where('status', 'published')
                ->whereNotIn('id', $excludeIds)
                ->where('bloom_level', $level)
                ->whereHas('topic.domain', function($query) use ($domainId) {
                    $query->where('id', $domainId);
                })
                ->count();
                
            $this->line("  Level {$level}: {$count} questions");
        }

        // Check phase constraint
        $this->newLine();
        $this->info("Checking phase constraint:");
        $phaseId = $domain->phase_id;
        $this->info("Domain is in Phase {$phaseId}");

        return 0;
    }
}