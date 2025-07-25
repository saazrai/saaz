<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticItem extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
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

    public function topic(): BelongsTo
    {
        return $this->belongsTo(DiagnosticTopic::class, 'topic_id');
    }

    public function subtopic(): BelongsTo
    {
        return $this->belongsTo(DiagnosticSubtopic::class, 'subtopic_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

}
