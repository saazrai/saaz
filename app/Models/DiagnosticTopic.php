<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiagnosticTopic extends BaseModel
{
    protected $fillable = ['domain_id', 'name', 'description'];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(DiagnosticDomain::class, 'domain_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(DiagnosticItem::class, 'topic_id');
    }
}
