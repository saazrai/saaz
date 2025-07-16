<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DiagnosticSummary extends Command
{
    protected $signature = 'diagnostic:summary 
                          {diagnostic? : The diagnostic ID to analyze}';

    protected $description = 'Get a summary of diagnostic assessment to understand why it took many questions';

    public function handle()
    {
        $diagnosticId = $this->argument('diagnostic');
        
        if (!$diagnosticId) {
            $this->showHelp();
            return 0;
        }
        
        $diagnostic = Diagnostic::with(['user', 'responses'])->find($diagnosticId);
        
        if (!$diagnostic) {
            $this->error("Diagnostic with ID {$diagnosticId} not found.");
            return 1;
        }

        $this->info("=== DIAGNOSTIC SUMMARY FOR ID {$diagnosticId} ===");
        $this->newLine();
        
        // Basic Info
        $this->info("BASIC INFORMATION:");
        $this->line("User: " . ($diagnostic->user->name ?? 'Unknown'));
        $this->line("Status: " . ucfirst($diagnostic->status));
        $this->line("Total Questions: " . $diagnostic->responses->count());
        $this->line("Score: " . ($diagnostic->score ? round($diagnostic->score, 1) . '%' : 'N/A'));
        $this->line("Duration: " . ($diagnostic->total_duration_seconds ? gmdate("H:i:s", $diagnostic->total_duration_seconds) : 'N/A'));
        $this->line("Current Phase: " . ($diagnostic->phase?->order_sequence ?? 'N/A'));
        $this->line("Created: " . $diagnostic->created_at->format('Y-m-d H:i:s'));
        
        // Analyze responses
        $responses = $diagnostic->responses;
        $totalQuestions = $responses->count();
        $correctAnswers = $responses->where('is_correct', true)->count();
        $incorrectAnswers = $totalQuestions - $correctAnswers;
        $accuracy = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 1) : 0;
        
        $this->newLine();
        $this->info("PERFORMANCE ANALYSIS:");
        $this->line("Correct Answers: {$correctAnswers}");
        $this->line("Incorrect Answers: {$incorrectAnswers}");
        $this->line("Overall Accuracy: {$accuracy}%");
        
        // Analyze response times
        $avgResponseTime = $responses->avg('response_time_seconds');
        $minResponseTime = $responses->min('response_time_seconds');
        $maxResponseTime = $responses->max('response_time_seconds');
        
        $this->newLine();
        $this->info("RESPONSE TIME ANALYSIS:");
        $this->line("Average Response Time: " . round($avgResponseTime, 1) . " seconds");
        $this->line("Fastest Response: " . round($minResponseTime, 1) . " seconds");
        $this->line("Slowest Response: " . round($maxResponseTime, 1) . " seconds");
        
        // Analyze question progression
        $chunks = $responses->chunk(10);
        $this->newLine();
        $this->info("ACCURACY PROGRESSION (by 10-question chunks):");
        
        foreach ($chunks as $index => $chunk) {
            $chunkCorrect = $chunk->where('is_correct', true)->count();
            $chunkAccuracy = round(($chunkCorrect / $chunk->count()) * 100, 1);
            $questionRange = (($index * 10) + 1) . "-" . (($index * 10) + $chunk->count());
            $this->line("Questions {$questionRange}: {$chunkAccuracy}% accuracy ({$chunkCorrect}/{$chunk->count()} correct)");
        }
        
        // Find consecutive incorrect streaks
        $maxConsecutiveIncorrect = 0;
        $currentStreak = 0;
        $incorrectStreaks = [];
        
        foreach ($responses as $response) {
            if (!$response->is_correct) {
                $currentStreak++;
                $maxConsecutiveIncorrect = max($maxConsecutiveIncorrect, $currentStreak);
            } else {
                if ($currentStreak >= 3) {
                    $incorrectStreaks[] = $currentStreak;
                }
                $currentStreak = 0;
            }
        }
        if ($currentStreak >= 3) {
            $incorrectStreaks[] = $currentStreak;
        }
        
        $this->newLine();
        $this->info("PERFORMANCE PATTERNS:");
        $this->line("Maximum consecutive incorrect: {$maxConsecutiveIncorrect}");
        if (count($incorrectStreaks) > 0) {
            $this->line("Incorrect answer streaks (3+): " . implode(', ', $incorrectStreaks));
        }
        
        // Explain why it took so many questions
        $this->newLine();
        $this->info("WHY DID THIS ASSESSMENT TAKE {$totalQuestions} QUESTIONS?");
        
        $reasons = [];
        
        if ($totalQuestions >= 100) {
            $reasons[] = "✅ Reached maximum question limit (100)";
        }
        
        if ($accuracy >= 40 && $accuracy <= 70) {
            $reasons[] = "• Mixed performance ({$accuracy}% accuracy) - too high to stop early, too low for mastery";
        } elseif ($accuracy < 40) {
            $reasons[] = "• Low accuracy ({$accuracy}%) - system continued to find appropriate difficulty level";
        } elseif ($accuracy > 85) {
            $reasons[] = "• High accuracy ({$accuracy}%) - system tested upper skill boundaries";
        }
        
        if ($maxConsecutiveIncorrect >= 5) {
            $reasons[] = "• Had {$maxConsecutiveIncorrect} consecutive incorrect answers - indicates difficulty calibration issues";
        }
        
        // Check for unstable performance
        $chunkAccuracies = [];
        foreach ($chunks as $chunk) {
            $chunkAccuracies[] = $chunk->where('is_correct', true)->count() / $chunk->count() * 100;
        }
        if (count($chunkAccuracies) > 1) {
            $accuracyVariance = max($chunkAccuracies) - min($chunkAccuracies);
            if ($accuracyVariance > 40) {
                $reasons[] = "• Unstable performance (variance: " . round($accuracyVariance, 1) . "%) - inconsistent results prevent early termination";
            }
        }
        
        // Phase-based testing
        $currentPhase = $diagnostic->phase?->order_sequence ?? 1;
        if ($currentPhase > 1) {
            $reasons[] = "• Multi-phase assessment (reached phase {$currentPhase}) - each phase requires minimum questions";
        }
        
        foreach ($reasons as $reason) {
            $this->line($reason);
        }
        
        $this->newLine();
        $this->info("RECOMMENDATIONS:");
        
        if ($accuracy >= 40 && $accuracy <= 70) {
            $this->line("• Consider focused practice before reassessment");
        }
        
        if ($maxConsecutiveIncorrect >= 5) {
            $this->line("• Review adaptive algorithm's difficulty adjustment logic");
        }
        
        if ($totalQuestions >= 100) {
            $this->line("• Assessment hit maximum limit - consider adjusting termination criteria");
            $this->line("• Review if all phases/domains need to be tested in one session");
        }
        
        $this->newLine();
        $this->info("KEY INSIGHTS:");
        $this->line("• 85% confidence means the system is 85% confident in its assessment of your knowledge");
        $this->line("• 74% completion means you answered 74% of the estimated total questions needed");
        $this->line("• The assessment continued because it hadn't reached sufficient confidence across all domains");
        
        // Add proficiency level summary
        $this->newLine();
        $this->info("PROFICIENCY LEVELS:");
        $this->showProficiencyLevels($responses);
        
        return 0;
    }
    
    private function showProficiencyLevels($responses)
    {
        $adaptiveService = app(\App\Services\AdaptiveDiagnosticService::class);
        $domainProficiencies = [];
        
        // Group responses by domain
        foreach ($responses as $response) {
            $item = $response->diagnosticItem;
            if (!$item || !$item->topic || !$item->topic->domain) continue;
            
            $domainId = $item->topic->domain->id;
            $domainName = $item->topic->domain->name;
            
            if (!isset($domainProficiencies[$domainId])) {
                $domainProficiencies[$domainId] = [
                    'name' => $domainName,
                    'answers' => [],
                    'bloom_history' => []
                ];
            }
            
            $domainProficiencies[$domainId]['answers'][] = $response->is_correct;
            $domainProficiencies[$domainId]['bloom_history'][] = $item->bloom_level ?? 3;
        }
        
        // Calculate and display proficiency levels
        foreach ($domainProficiencies as $domainId => $data) {
            $state = [
                'domain_history' => [$domainId => $data['answers']],
                'domain_bloom_history' => [$domainId => $data['bloom_history']]
            ];
            
            $level = $adaptiveService->calculateFinalProficiencyLevel($domainId, $state);
            $label = $adaptiveService->getProficiencyLabel($level);
            
            $this->line("• {$data['name']}: {$level} - {$label}");
        }
    }
    
    private function showHelp()
    {
        $this->info('NAME');
        $this->line('  diagnostic:summary - Analyze why a diagnostic assessment took many questions');
        
        $this->newLine();
        $this->info('SYNOPSIS');
        $this->line('  php artisan diagnostic:summary <diagnostic-id>');
        $this->line('  php artisan diagnostic:summary --help');
        
        $this->newLine();
        $this->info('DESCRIPTION');
        $this->line('  This command analyzes a diagnostic assessment to understand why it took a certain');
        $this->line('  number of questions to complete. It provides insights into:');
        $this->line('  - Performance patterns and accuracy progression');
        $this->line('  - Response time analysis');
        $this->line('  - Consecutive incorrect answer streaks');
        $this->line('  - Reasons for extended assessment length');
        
        $this->newLine();
        $this->info('ARGUMENTS');
        $this->line('  diagnostic-id    The ID of the diagnostic to analyze');
        
        $this->newLine();
        $this->info('OPTIONS');
        $this->line('  -h, --help       Display this help message');
        
        $this->newLine();
        $this->info('EXAMPLES');
        $this->line('  # Analyze diagnostic with ID 1');
        $this->line('  php artisan diagnostic:summary 1');
        
        $this->newLine();
        $this->line('  # Show help');
        $this->line('  php artisan diagnostic:summary --help');
    }
}