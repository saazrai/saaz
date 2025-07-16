# Adaptive State Refactoring Summary

## Changes Implemented

### 1. IRT Parameters (Already Correct)
- IRT parameters (a, b, c) are properly stored in `diagnostic_items` table
- No changes needed - these are item-level parameters

### 2. Minimal Adaptive State
Created migration to refactor `adaptive_state` to minimal structure:
```json
{
  "domain_bloom_levels": {
    "1": 3,    // Domain 1 at bloom level 3
    "2": 4     // Domain 2 at bloom level 4
  },
  "domain_streaks": {
    "1": {"correct": 2, "incorrect": 0},
    "2": {"correct": 0, "incorrect": 1}
  }
}
```

Benefits:
- Eliminates redundant data (phases, domains_tested, questions_asked)
- Stores only non-derivable state
- Simpler to maintain and understand

### 3. Duration Tracking Fixed
Updated `DiagnosticController::submitAnswer()` to:
```php
// Increment duration with each answer
$diagnostic->increment('total_duration_seconds', $validated['response_time']);

// On completion, recalculate total from all responses
$totalDuration = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
    ->whereNotNull('response_time_seconds')
    ->sum('response_time_seconds');
```

### 4. Created MinimalAdaptiveDiagnosticService
New service with simplified logic:
- Tracks bloom level per domain (not global)
- Simple streak-based progression (3 correct → level up, 2 incorrect → level down)
- Domain-specific performance tracking
- Clear completion criteria

## Migration Path

1. Run the migration to convert existing adaptive_state data
2. Update code to use MinimalAdaptiveDiagnosticService
3. Remove redundant state tracking code

## Next Steps

1. **Test the changes** with existing diagnostics
2. **Update AdaptiveDiagnosticService** to use minimal state
3. **Remove old state fields** from code
4. **Add IRT calculations** when ready (using existing a, b, c parameters)