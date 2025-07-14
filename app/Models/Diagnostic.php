<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends BaseModel
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'status',
        'mode',
        'total_questions',
        'current_question',
        'total_duration_seconds',
        'score',
        'current_phase',
        'current_domain',
        'current_phase_id',
        'target_phases',
        'phase_progress',
        'phases_completed',
        'domains_completed',
        'phase_completion_times',
        'domain_progress',
        'ability',
        'standard_error',
        'adaptive_state',
    ];

    protected $casts = [
        'adaptive_state' => 'array',
        'target_phases' => 'array',
        'phase_progress' => 'array',
        'phases_completed' => 'array',
        'domains_completed' => 'array',
        'phase_completion_times' => 'array',
        'domain_progress' => 'array',
    ];

    /**
     * Get duration in minutes
     */
    public function getDurationMinutesAttribute(): ?int
    {
        if ($this->total_duration_seconds) {
            return (int) round($this->total_duration_seconds / 60);
        }
        
        return null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currentPhase(): BelongsTo
    {
        return $this->belongsTo(DiagnosticPhase::class, 'current_phase_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(DiagnosticResponse::class);
    }

    public function diagnosticResponses(): HasMany
    {
        return $this->hasMany(DiagnosticResponse::class);
    }

    /**
     * Get all target phases for this diagnostic
     */
    public function targetPhases()
    {
        if (empty($this->target_phases)) {
            return DiagnosticPhase::query()->active()->ordered();
        }
        
        return DiagnosticPhase::whereIn('id', $this->target_phases)->ordered();
    }

    /**
     * Check if a phase is completed
     */
    public function isPhaseCompleted(int $phaseId): bool
    {
        return in_array($phaseId, $this->phases_completed ?? []);
    }

    /**
     * Get progress for a specific phase
     */
    public function getPhaseProgress(int $phaseId): array
    {
        $progress = $this->phase_progress ?? [];
        return $progress[$phaseId] ?? [
            'domains_completed' => 0,
            'questions_answered' => 0,
            'started_at' => null,
            'completed_at' => null,
        ];
    }
}
