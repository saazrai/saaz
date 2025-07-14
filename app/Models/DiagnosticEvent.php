<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Prunable;

class DiagnosticEvent extends BaseModel
{
    use Prunable;
    protected $fillable = [
        'event_type',
        'user_id',
        'diagnostic_id',
        'domain_id',
        'payload',
        'processed',
        'processed_at',
        'processed_by',
        'failed',
        'error_message',
        'retry_count',
        'priority',
        'expires_at',
    ];
    
    protected $casts = [
        'payload' => 'array',
        'processed' => 'boolean',
        'failed' => 'boolean',
        'processed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function diagnostic(): BelongsTo
    {
        return $this->belongsTo(Diagnostic::class);
    }
    
    public function domain(): BelongsTo
    {
        return $this->belongsTo(DiagnosticDomain::class, 'domain_id');
    }
    
    /**
     * Scope for pending events
     */
    public function scopePending($query)
    {
        return $query->where('processed', false)
            ->where('failed', false)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }
    
    /**
     * Scope for high priority events
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }
    
    /**
     * Get the prunable model query.
     * Remove events that are processed and older than 90 days
     */
    public function prunable()
    {
        return static::where('processed', true)
            ->where('processed_at', '<=', now()->subDays(90));
    }
}