<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleQuizAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'total_questions',
        'score',
        'completion_time_seconds',
        'status',
        'user_agent',
        'ip_address',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'total_questions' => 'integer',
        'score' => 'integer',
        'completion_time_seconds' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the responses for this assessment
     */
    public function responses(): HasMany
    {
        return $this->hasMany(SampleQuizResponse::class)->orderBy('question_sequence');
    }

    /**
     * Scope for completed assessments
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for recent assessments
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('completed_at', '>=', now()->subDays($days));
    }

    /**
     * Get completion statistics
     */
    public static function getCompletionStats($days = 30)
    {
        $assessments = static::recent($days)->completed();
        
        return [
            'total_completions' => $assessments->count(),
            'average_score' => round($assessments->avg('score'), 1),
            'average_completion_time' => round($assessments->avg('completion_time_seconds') / 60, 1), // in minutes
            'score_distribution' => [
                'excellent' => $assessments->where('score', '>=', 80)->count(),
                'good' => $assessments->whereBetween('score', [60, 79])->count(),
                'needs_improvement' => $assessments->where('score', '<', 60)->count(),
            ]
        ];
    }

    /**
     * Get question-level analytics
     */
    public static function getQuestionAnalytics()
    {
        $responses = SampleQuizResponse::with('assessment')
            ->whereHas('assessment', function ($query) {
                $query->where('status', 'completed');
            })
            ->get()
            ->groupBy('question_id');

        $questionStats = [];

        foreach ($responses as $questionId => $questionResponses) {
            $totalAttempts = $questionResponses->count();
            $correctAttempts = $questionResponses->where('is_correct', true)->count();
            $averageResponseTime = $questionResponses->whereNotNull('response_time_seconds')->avg('response_time_seconds');

            $questionStats[] = [
                'question_id' => $questionId,
                'total_attempts' => $totalAttempts,
                'correct_attempts' => $correctAttempts,
                'accuracy_rate' => $totalAttempts ? round(($correctAttempts / $totalAttempts) * 100, 1) : 0,
                'average_response_time' => $averageResponseTime ? round($averageResponseTime, 1) : null,
                // Include metadata from most recent response
                'domain' => $questionResponses->first()->domain,
                'topic' => $questionResponses->first()->topic,
                'difficulty' => $questionResponses->first()->difficulty,
                'bloom_level' => $questionResponses->first()->bloom_level,
            ];
        }

        return $questionStats;
    }

    /**
     * Calculate and update the final score
     */
    public function calculateScore(): void
    {
        $responses = $this->responses;
        $totalQuestions = $responses->count();
        
        if ($totalQuestions === 0) {
            $this->score = 0;
            return;
        }

        $correctAnswers = $responses->where('is_correct', true)->count();
        $this->score = round(($correctAnswers / $totalQuestions) * 100);
        $this->save();
    }

    /**
     * Mark assessment as completed
     */
    public function markCompleted(): void
    {
        $this->status = 'completed';
        $this->completed_at = now();
        $this->calculateScore();
        $this->save();
    }
}