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


    public function subtopics(): HasMany
    {
        return $this->hasMany(DiagnosticSubtopic::class, 'topic_id');
    }
}
