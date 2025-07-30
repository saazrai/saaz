<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SampleQuizResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_quiz_assessment_id',
        'diagnostic_item_id',
        'question_sequence',
        'user_answer',
        'is_correct',
        'response_time_seconds',
        'metadata',
    ];

    protected $casts = [
        'user_answer' => 'array',
        'is_correct' => 'boolean',
        'diagnostic_item_id' => 'integer',
        'question_sequence' => 'integer',
        'response_time_seconds' => 'integer',
        'metadata' => 'array',
    ];

    /**
     * Get the assessment this response belongs to
     */
    public function assessment(): BelongsTo
    {
        return $this->belongsTo(SampleQuizAssessment::class, 'sample_quiz_assessment_id');
    }

    /**
     * Get the diagnostic item this response is for
     */
    public function diagnosticItem(): BelongsTo
    {
        return $this->belongsTo(DiagnosticItem::class);
    }

    /**
     * Scope for correct responses only
     */
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    /**
     * Scope for incorrect responses only
     */
    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }

    /**
     * Scope by domain
     */
    public function scopeByDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    /**
     * Scope by difficulty
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Scope by Bloom level
     */
    public function scopeByBloomLevel($query, $bloomLevel)
    {
        return $query->where('bloom_level', $bloomLevel);
    }

    /**
     * Get analytics by domain
     */
    public static function getDomainAnalytics()
    {
        return static::selectRaw('
                domain,
                COUNT(*) as total_responses,
                SUM(CASE WHEN is_correct = true THEN 1 ELSE 0 END) as correct_responses,
                ROUND(AVG(CASE WHEN is_correct = true THEN 100 ELSE 0 END), 1) as accuracy_rate,
                ROUND(AVG(response_time_seconds), 1) as avg_response_time
            ')
            ->whereNotNull('domain')
            ->groupBy('domain')
            ->orderBy('accuracy_rate', 'desc')
            ->get();
    }

    /**
     * Get analytics by difficulty level
     */
    public static function getDifficultyAnalytics()
    {
        return static::selectRaw('
                difficulty,
                COUNT(*) as total_responses,
                SUM(CASE WHEN is_correct = true THEN 1 ELSE 0 END) as correct_responses,
                ROUND(AVG(CASE WHEN is_correct = true THEN 100 ELSE 0 END), 1) as accuracy_rate,
                ROUND(AVG(response_time_seconds), 1) as avg_response_time
            ')
            ->whereNotNull('difficulty')
            ->groupBy('difficulty')
            ->orderByRaw("CASE difficulty 
                WHEN 'Easy' THEN 1 
                WHEN 'Medium' THEN 2 
                WHEN 'Hard' THEN 3 
                WHEN 'Expert' THEN 4 
                ELSE 5 END")
            ->get();
    }

    /**
     * Get analytics by Bloom level
     */
    public static function getBloomAnalytics()
    {
        return static::selectRaw('
                bloom_level,
                COUNT(*) as total_responses,
                SUM(CASE WHEN is_correct = true THEN 1 ELSE 0 END) as correct_responses,
                ROUND(AVG(CASE WHEN is_correct = true THEN 100 ELSE 0 END), 1) as accuracy_rate,
                ROUND(AVG(response_time_seconds), 1) as avg_response_time
            ')
            ->whereNotNull('bloom_level')
            ->groupBy('bloom_level')
            ->orderByRaw("CASE bloom_level 
                WHEN 'Remember' THEN 1 
                WHEN 'Understand' THEN 2 
                WHEN 'Apply' THEN 3 
                WHEN 'Analyze' THEN 4 
                WHEN 'Evaluate' THEN 5 
                WHEN 'Create' THEN 6 
                ELSE 7 END")
            ->get();
    }
}