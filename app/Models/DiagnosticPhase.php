<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiagnosticPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order_sequence',
        'min_questions_per_domain',
        'target_domains',
        'completion_criteria',
        'is_active',
        'color',
        'icon',
    ];

    protected $casts = [
        'completion_criteria' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the domains that belong to this phase.
     */
    public function domains(): HasMany
    {
        return $this->hasMany(DiagnosticDomain::class, 'phase_id')
            ->orderBy('phase_order');
    }

    /**
     * Get the diagnostics currently in this phase.
     */
    public function diagnostics(): HasMany
    {
        return $this->hasMany(Diagnostic::class, 'current_phase_id');
    }

    /**
     * Scope to get only active phases.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get phases in order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_sequence');
    }

    /**
     * Get the next phase in sequence.
     */
    public function nextPhase(): ?DiagnosticPhase
    {
        return static::where('order_sequence', '>', $this->order_sequence)
            ->active()
            ->ordered()
            ->first();
    }

    /**
     * Get the previous phase in sequence.
     */
    public function previousPhase(): ?DiagnosticPhase
    {
        return static::where('order_sequence', '<', $this->order_sequence)
            ->active()
            ->ordered()
            ->orderBy('order_sequence', 'desc')
            ->first();
    }

    /**
     * Check if this phase is complete for a diagnostic.
     */
    public function isCompleteForDiagnostic(Diagnostic $diagnostic): bool
    {
        $completedPhases = $diagnostic->phases_completed ?? [];

        return in_array($this->id, $completedPhases);
    }

    /**
     * Get completion progress for this phase in a diagnostic.
     */
    public function getProgressForDiagnostic(Diagnostic $diagnostic): array
    {
        $phaseProgress = $diagnostic->phase_progress ?? [];

        return $phaseProgress[$this->id] ?? [
            'domains_completed' => 0,
            'total_domains' => $this->target_domains,
            'questions_answered' => 0,
            'started_at' => null,
            'completed_at' => null,
        ];
    }
}
