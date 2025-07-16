<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Diagnostic extends BaseModel implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'user_id',
        'status',
        'total_duration_seconds',
        'score',
        'phase_id',
        'completed_at',
        'ability',
        'standard_error',
        'adaptive_state',
    ];

    protected $casts = [
        'adaptive_state' => 'array',
        'completed_at' => 'datetime',
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

    public function phase(): BelongsTo
    {
        return $this->belongsTo(DiagnosticPhase::class, 'phase_id');
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
     * Since progression is linear, any phase before current is completed
     */
    public function isPhaseCompleted(int $phaseId): bool
    {
        if (!$this->phase) {
            return false;
        }
        
        $requestedPhase = DiagnosticPhase::find($phaseId);
        if (!$requestedPhase) {
            return false;
        }
        
        return $requestedPhase->order_sequence < $this->phase->order_sequence;
    }

    /**
     * Get progress for a specific phase
     */
    public function getPhaseProgress(int $phaseId): array
    {
        $progress = $this->domain_progress ?? [];
        return $progress[$phaseId] ?? [
            'domains_completed' => 0,
            'questions_answered' => 0,
            'started_at' => null,
            'completed_at' => null,
        ];
    }

    /**
     * Audit configuration
     */
    protected $auditInclude = [
        'status',
        'score',
        'phase_id',
        'completed_at',
    ];

    protected $auditStrict = true;
}
