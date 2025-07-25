<?php

namespace App\Services;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Simplified DiagnosticQuestionGenerationService
 *
 * Uses pre-seeded questions (50 per domain with Bloom distribution).
 * This service retrieves questions from the database rather than generating new ones.
 */
class DiagnosticQuestionGenerationService
{
    private const CACHE_TTL = 3600; // 1 hour cache for question pools

    /**
     * Constructor - no AI service needed
     */
    public function __construct()
    {
        // No AI generation needed, using seeded questions
    }

    /**
     * Get diagnostic questions for a specific domain and bloom level
     * Retrieves from seeded questions instead of generating
     */
    public function generateQuestions(int $domainId, int $bloomLevel, int $count = 5): array
    {
        $cacheKey = "diagnostic_questions_{$domainId}_{$bloomLevel}_{$count}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($domainId, $bloomLevel, $count) {
            // Get topics for this domain
            $topicIds = DiagnosticTopic::where('domain_id', $domainId)
                ->pluck('id')
                ->toArray();

            if (empty($topicIds)) {
                Log::warning('No topics found for domain', ['domain_id' => $domainId]);

                return [];
            }

            // Retrieve questions from seeded data
            $questions = DiagnosticItem::whereIn('topic_id', $topicIds)
                ->where('bloom_level', $bloomLevel)
                ->where('status', 'published')
                ->inRandomOrder()
                ->limit($count)
                ->get();

            Log::info('Retrieved diagnostic questions', [
                'domain_id' => $domainId,
                'bloom_level' => $bloomLevel,
                'requested' => $count,
                'found' => $questions->count(),
            ]);

            return $questions->toArray();
        });
    }

    /**
     * Check if more questions are needed for a domain/bloom combination
     * Checks against seeded questions
     */
    public function needsMoreQuestions(int $domainId, int $bloomLevel, array $excludedIds = []): bool
    {
        $topicIds = DiagnosticTopic::where('domain_id', $domainId)
            ->pluck('id')
            ->toArray();

        $availableCount = DiagnosticItem::whereIn('topic_id', $topicIds)
            ->where('bloom_level', $bloomLevel)
            ->where('status', 'published')
            ->whereNotIn('id', $excludedIds)
            ->count();

        // Need at least 2 questions per combination
        return $availableCount < 2;
    }

    /**
     * Ensure minimum questions exist for a domain
     * Validates seeded data completeness
     */
    public function ensureMinimumQuestions(int $domainId): bool
    {
        $domain = DiagnosticDomain::find($domainId);
        if (! $domain) {
            return false;
        }

        // Check each Bloom level has questions
        $bloomLevels = [1, 2, 3, 4, 5]; // Bloom 6 (Create) not used
        foreach ($bloomLevels as $level) {
            if ($this->needsMoreQuestions($domainId, $level)) {
                Log::warning('Insufficient questions for domain/bloom', [
                    'domain_id' => $domainId,
                    'bloom_level' => $level,
                ]);

                return false;
            }
        }

        return true;
    }

    /**
     * Get question pool size for a domain and bloom level
     */
    public function getQuestionPoolSize(int $domainId, int $bloomLevel): int
    {
        $topicIds = DiagnosticTopic::where('domain_id', $domainId)
            ->pluck('id')
            ->toArray();

        return DiagnosticItem::whereIn('topic_id', $topicIds)
            ->where('bloom_level', $bloomLevel)
            ->where('status', 'published')
            ->count();
    }
}
