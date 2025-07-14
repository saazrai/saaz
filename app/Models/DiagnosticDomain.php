<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosticDomain extends BaseModel
{
    protected $fillable = [
        'name', 
        'description',
        'phase_id',
        'phase_order',
        'priority_order',
        'category',
        'code',
        'weight_percentage',
        'color',
        'icon',
        'is_active',
        'min_bloom_level',
        'max_bloom_level',
        'learning_objectives',
        'prerequisites'
    ];

    protected $casts = [
        'phase_id' => 'integer',
        'phase_order' => 'integer',
        'priority_order' => 'integer',
        'weight_percentage' => 'decimal:2',
        'is_active' => 'boolean',
        'min_bloom_level' => 'integer',
        'max_bloom_level' => 'integer',
        'prerequisites' => 'array',
    ];

    public function phase(): BelongsTo
    {
        return $this->belongsTo(DiagnosticPhase::class, 'phase_id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(DiagnosticTopic::class, 'domain_id');
    }

    /**
     * Scope to get domains in priority order
     */
    public function scopeInPriorityOrder($query)
    {
        return $query->orderBy('priority_order')->orderBy('id');
    }

    /**
     * Scope to get active domains only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get domains by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get domains by phase
     */
    public function scopeByPhase($query, int $phaseId)
    {
        return $query->where('phase_id', $phaseId);
    }

    /**
     * Scope to get domains in phase order
     */
    public function scopeInPhaseOrder($query)
    {
        return $query->orderBy('phase_order')->orderBy('id');
    }

    /**
     * Get top N domains by priority
     */
    public static function getTopByPriority(int $count)
    {
        return static::active()->inPriorityOrder()->limit($count)->get();
    }

    /**
     * Get color class for UI
     */
    public function getColorClass(): string
    {
        $colorMap = [
            'blue' => 'bg-blue-100 text-blue-800',
            'purple' => 'bg-purple-100 text-purple-800',
            'gray' => 'bg-gray-100 text-gray-800',
            'indigo' => 'bg-indigo-100 text-indigo-800',
            'orange' => 'bg-orange-100 text-orange-800',
            'teal' => 'bg-teal-100 text-teal-800',
            'red' => 'bg-red-100 text-red-800',
            'green' => 'bg-green-100 text-green-800',
            'amber' => 'bg-amber-100 text-amber-800',
            'cyan' => 'bg-cyan-100 text-cyan-800',
            'lime' => 'bg-lime-100 text-lime-800',
            'pink' => 'bg-pink-100 text-pink-800',
            'brown' => 'bg-brown-100 text-brown-800',
        ];

        return $colorMap[$this->color] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get category display name
     */
    public function getCategoryDisplayName(): string
    {
        return match($this->category) {
            'foundational' => 'Foundational',
            'technical' => 'Technical',
            'managerial' => 'Managerial',
            default => 'General'
        };
    }

    /**
     * Check if domain has prerequisites
     */
    public function hasPrerequisites(): bool
    {
        return !empty($this->prerequisites);
    }

    /**
     * Get prerequisite domains
     */
    public function getPrerequisiteDomains()
    {
        if (!$this->hasPrerequisites()) {
            return collect();
        }

        return static::whereIn('id', $this->prerequisites)->get();
    }
}
