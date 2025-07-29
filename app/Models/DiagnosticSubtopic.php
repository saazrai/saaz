<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticSubtopic extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'name',
        'description',
        'sort_order',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(DiagnosticTopic::class, 'topic_id');
    }

    public function diagnosticItems(): HasMany
    {
        return $this->hasMany(DiagnosticItem::class, 'subtopic_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
