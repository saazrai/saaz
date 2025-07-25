<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosticTestResult extends BaseModel
{
    protected $fillable = [
        'user_id',
        'overall_score',
        'recommended_level',
        'domain_scores',
        'domain_recommendations',
        'bloom_distribution',
        'question_count',
        'correct_count',
        'time_taken',
        'completed_at',
    ];

    protected $casts = [
        'overall_score' => 'float',
        'domain_scores' => 'array',
        'domain_recommendations' => 'array',
        'bloom_distribution' => 'array',
        'question_count' => 'integer',
        'correct_count' => 'integer',
        'time_taken' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the recommended difficulty level based on score
     */
    public static function calculateRecommendedLevel(float $score): string
    {
        if ($score >= 85) {
            return 'advanced';
        } elseif ($score >= 70) {
            return 'intermediate';
        } else {
            return 'beginner';
        }
    }
}
