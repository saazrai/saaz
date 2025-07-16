<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AnalyzeDiagnosticSimple extends Command
{
    protected $signature = 'diagnostic:analyze-simple 
                          {diagnostic : The diagnostic ID to analyze}';

    protected $description = 'Simple analysis of diagnostic bloom progression';

    public function handle()
    {
        $diagnosticId = $this->argument('diagnostic');
        
        // Get diagnostic with basic info
        $diagnostic = Diagnostic::with(['user', 'responses'])->find($diagnosticId);
        
        if (!$diagnostic) {
            $this->error("Diagnostic with ID {$diagnosticId} not found.");
            return 1;
        }

        $this->info("=== DIAGNOSTIC ANALYSIS ===");
        $this->info("User: " . ($diagnostic->user->name ?? 'Unknown'));
        $this->info("Status: " . ucfirst($diagnostic->status));
        $this->info("Total Questions: " . $diagnostic->responses->count());
        $this->info("Score: " . ($diagnostic->score ? round($diagnostic->score, 1) . '%' : 'N/A'));
        $this->info("Duration: " . ($diagnostic->total_duration_seconds ? gmdate("H:i:s", $diagnostic->total_duration_seconds) : 'N/A'));
        
        // Get responses with question details using raw query
        $responses = DB::table('diagnostic_responses as dr')
            ->join('diagnostic_items as di', 'dr.diagnostic_item_id', '=', 'di.id')
            ->leftJoin('diagnostic_topics as dt', 'di.topic_id', '=', 'dt.id')
            ->leftJoin('diagnostic_domains as dd', 'dt.domain_id', '=', 'dd.id')
            ->where('dr.diagnostic_id', $diagnosticId)
            ->orderBy('dr.created_at')
            ->select([
                'dr.*',
                'di.bloom_id',
                'di.difficulty_id',
                'di.type_id',
                'di.content',
                'dd.name as domain_name',
                'dt.name as topic_name'
            ])
            ->get();

        if ($responses->isEmpty()) {
            $this->warn("No responses found.");
            return 0;
        }

        $this->newLine();
        $this->info("BLOOM LEVEL PROGRESSION:");
        
        // Analyze bloom progression
        $bloomProgression = [];
        $domainStats = [];
        $consecutiveIncorrect = 0;
        
        foreach ($responses as $index => $response) {
            $domain = $response->domain_name ?? 'Unknown';
            $bloomLevel = $response->bloom_id ?? 1;
            $isCorrect = $response->is_correct;
            
            // Track domain stats
            if (!isset($domainStats[$domain])) {
                $domainStats[$domain] = [
                    'count' => 0,
                    'correct' => 0,
                    'bloom_levels' => [],
                ];
            }
            $domainStats[$domain]['count']++;
            if ($isCorrect) {
                $domainStats[$domain]['correct']++;
                $consecutiveIncorrect = 0;
            } else {
                $consecutiveIncorrect++;
            }
            $domainStats[$domain]['bloom_levels'][] = $bloomLevel;
            
            // Show every 10th question or last
            if ($index % 10 === 0 || $index === count($responses) - 1) {
                $bloomProgression[] = [
                    'Question' => $index + 1,
                    'Domain' => $domain,
                    'Bloom Level' => $bloomLevel,
                    'Correct' => $isCorrect ? '✅' : '❌',
                    'Consecutive Incorrect' => $consecutiveIncorrect
                ];
            }
        }
        
        $this->table(
            ['Question', 'Domain', 'Bloom Level', 'Correct', 'Consecutive Incorrect'],
            $bloomProgression
        );
        
        $this->newLine();
        $this->info("DOMAIN STATISTICS:");
        
        $domainTable = [];
        foreach ($domainStats as $domain => $stats) {
            $accuracy = $stats['count'] > 0 
                ? round(($stats['correct'] / $stats['count']) * 100, 1) 
                : 0;
            $avgBloom = count($stats['bloom_levels']) > 0
                ? round(array_sum($stats['bloom_levels']) / count($stats['bloom_levels']), 1)
                : 0;
            $bloomRange = count($stats['bloom_levels']) > 0
                ? min($stats['bloom_levels']) . '-' . max($stats['bloom_levels'])
                : 'N/A';
                
            $domainTable[] = [
                $domain,
                $stats['count'],
                $accuracy . '%',
                $avgBloom,
                $bloomRange
            ];
        }
        
        $this->table(
            ['Domain', 'Questions', 'Accuracy', 'Avg Bloom', 'Bloom Range'],
            $domainTable
        );
        
        // Analyze why it took so many questions
        $this->newLine();
        $this->info("WHY DID THIS ASSESSMENT TAKE {$responses->count()} QUESTIONS?");
        
        $reasons = [];
        
        // Check accuracy
        $totalCorrect = $responses->where('is_correct', true)->count();
        $accuracy = ($totalCorrect / $responses->count()) * 100;
        
        if ($accuracy >= 30 && $accuracy <= 70) {
            $reasons[] = "• Mixed performance (" . round($accuracy, 1) . "% accuracy) prevents early termination";
        }
        
        // Check domain count
        $uniqueDomains = $responses->pluck('domain_name')->unique()->filter()->count();
        if ($uniqueDomains >= 5) {
            $reasons[] = "• Testing many domains ({$uniqueDomains}) requires more questions";
        }
        
        // Check bloom variance
        $allBloomLevels = $responses->pluck('bloom_id')->filter();
        $bloomVariance = $allBloomLevels->unique()->count();
        if ($bloomVariance >= 4) {
            $reasons[] = "• High bloom level variation ({$bloomVariance} different levels) indicates knowledge gaps";
        }
        
        // Minimum coverage
        $minQuestionsPerDomain = 5;
        $totalMinRequired = $uniqueDomains * $minQuestionsPerDomain;
        if ($totalMinRequired > 50) {
            $reasons[] = "• Minimum domain coverage requires at least {$totalMinRequired} questions";
        }
        
        if ($responses->count() >= 80) {
            $reasons[] = "• Assessment exceeded typical length - may indicate algorithm issues or very broad testing scope";
        }
        
        foreach ($reasons as $reason) {
            $this->line($reason);
        }
        
        $this->newLine();
        $this->info("RECOMMENDATIONS:");
        if ($uniqueDomains >= 5) {
            $this->line("• Consider domain-specific assessments to reduce question count");
        }
        if ($bloomVariance >= 4) {
            $this->line("• Focus on specific skill levels rather than broad range");
        }
        if ($accuracy >= 30 && $accuracy <= 70) {
            $this->line("• Mixed performance suggests targeted practice before assessment");
        }
        
        return 0;
    }
}