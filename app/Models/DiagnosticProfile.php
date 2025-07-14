<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosticProfile extends BaseModel
{
    protected $fillable = [
        'user_id',
        'domain_id',
        'proficiency',
        'confidence',
        'last_bloom_level',
        'questions_answered',
        'questions_correct',
        'average_response_time',
        'consecutive_correct',
        'consecutive_incorrect',
        'bloom_distribution',
        'strengths',
        'weaknesses',
        'first_assessed_at',
        'last_assessed_at',
    ];
    
    protected $casts = [
        'proficiency' => 'decimal:2',
        'confidence' => 'decimal:2',
        'average_response_time' => 'decimal:2',
        'bloom_distribution' => 'array',
        'strengths' => 'array',
        'weaknesses' => 'array',
        'first_assessed_at' => 'datetime',
        'last_assessed_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function domain(): BelongsTo
    {
        return $this->belongsTo(DiagnosticDomain::class, 'domain_id');
    }
    
    /**
     * Get the days since last assessment
     */
    public function getDaysSinceLastAssessmentAttribute(): ?int
    {
        if (!$this->last_assessed_at) {
            return null;
        }
        
        return $this->last_assessed_at->diffInDays(now());
    }
}