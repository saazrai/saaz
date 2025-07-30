<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SampleQuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostic_item_id',
        'display_order',
    ];

    protected $casts = [
        'diagnostic_item_id' => 'integer',
        'display_order' => 'integer',
    ];

    /**
     * Get the diagnostic item this sample question references
     */
    public function diagnosticItem(): BelongsTo
    {
        return $this->belongsTo(DiagnosticItem::class);
    }

    /**
     * Get all sample questions in display order
     */
    public static function getSampleQuestionsInOrder()
    {
        return static::with('diagnosticItem')
            ->orderBy('display_order')
            ->get();
    }

    /**
     * Get the next available display order
     */
    public static function getNextDisplayOrder(): int
    {
        return static::max('display_order') + 1 ?? 1;
    }

    /**
     * Reorder questions after deletion
     */
    public static function reorderAfterDeletion(int $deletedOrder): void
    {
        static::where('display_order', '>', $deletedOrder)
            ->decrement('display_order');
    }

    /**
     * Check if a diagnostic item is already in sample quiz
     */
    public static function isDiagnosticItemInSample(int $diagnosticItemId): bool
    {
        return static::where('diagnostic_item_id', $diagnosticItemId)->exists();
    }
}