<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticItem extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'subtopic_id',
        'type_id',
        'dimension',
        'content',
        'options',
        'correct_options',
        'justifications',
        'settings',
        'difficulty_level',
        'bloom_level',
        'irt_a',
        'irt_b',
        'irt_c',
        'status',
    ];

    protected $casts = [
        'options' => 'array',
        'correct_options' => 'array',
        'justifications' => 'array',
        'settings' => 'array',
        'irt_a' => 'decimal:2',
        'irt_b' => 'decimal:2',
        'irt_c' => 'decimal:2',
    ];

    public function subtopic(): BelongsTo
    {
        return $this->belongsTo(DiagnosticSubtopic::class, 'subtopic_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

    /**
     * Get the sample quiz question record if this item is used in sample quiz
     */
    public function sampleQuizQuestion(): HasOne
    {
        return $this->hasOne(SampleQuizQuestion::class);
    }

    /**
     * Check if this diagnostic item is used in the sample quiz
     */
    public function isInSampleQuiz(): bool
    {
        return $this->sampleQuizQuestion()->exists();
    }
}
