<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DiagnosticResponse extends BaseModel implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $fillable = [
        'diagnostic_id',
        'diagnostic_item_id',
        'user_answer',
        'metadata',
        'is_correct',
        'response_time_seconds',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'user_answer' => 'array',
        'metadata' => 'array',
    ];

    public function diagnostic(): BelongsTo
    {
        return $this->belongsTo(Diagnostic::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(DiagnosticItem::class, 'diagnostic_item_id');
    }

    public function diagnosticItem(): BelongsTo
    {
        return $this->belongsTo(DiagnosticItem::class, 'diagnostic_item_id');
    }

    /**
     * Audit configuration
     */
    protected $auditInclude = [
        'diagnostic_id',
        'diagnostic_item_id',
        'user_answer',
        'metadata',
        'is_correct',
        'response_time_seconds',
    ];

    protected $auditStrict = true;
}
