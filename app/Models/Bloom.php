<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bloom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the diagnostic items for this bloom level.
     */
    public function diagnosticItems(): HasMany
    {
        return $this->hasMany(DiagnosticItem::class, 'bloom_level', 'id');
    }

    /**
     * Get the diagnostic profiles for this bloom level.
     */
    public function diagnosticProfiles(): HasMany
    {
        return $this->hasMany(DiagnosticProfile::class, 'current_bloom_level', 'id');
    }

    /**
     * Scope to get only active bloom levels.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get bloom level by code (L1, L2, etc).
     */
    public static function getByCode(string $code): ?self
    {
        return static::where('code', $code)->first();
    }

    /**
     * Get bloom level by numeric level (using ID).
     */
    public static function getByLevel(int $level): ?self
    {
        return static::find($level);
    }

    /**
     * Get the next bloom level.
     */
    public function getNextLevel(): ?self
    {
        return static::find($this->id + 1);
    }

    /**
     * Get the previous bloom level.
     */
    public function getPreviousLevel(): ?self
    {
        return static::find($this->id - 1);
    }

    /**
     * Check if this is the highest level.
     */
    public function isHighestLevel(): bool
    {
        return $this->id === 6;
    }

    /**
     * Check if this is the lowest level.
     */
    public function isLowestLevel(): bool
    {
        return $this->id === 1;
    }
}
