# Final Diagnostic Schema - Extreme Simplification

## Columns Removed (10 total)

1. ❌ `current_question` - Derive from response count
2. ❌ `current_phase` - Use `phase->order_sequence`
3. ❌ `current_phase_id` - Renamed to `phase_id`
4. ❌ `current_domain` - Get from current question
5. ❌ `phases_completed` - Linear progression
6. ❌ `phase_progress` - Calculate from responses
7. ❌ `target_phases` - Always test all phases
8. ❌ `domains_completed` - Query from responses
9. ❌ `domain_progress` - Calculate from responses
10. ❌ `domain_bloom_performance` - Store in adaptive_state if needed
11. ❌ `phase_completion_times` - Just use `completed_at`

## Final Schema (Only 11 columns + timestamps)

```php
Schema::create('diagnostics', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id');
    $table->enum('status', ['in_progress', 'paused', 'completed']);
    $table->integer('total_questions')->default(1000);
    $table->integer('total_duration_seconds')->nullable();
    $table->decimal('score', 5, 2)->nullable();
    $table->foreignId('phase_id')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->decimal('ability', 8, 4)->nullable();      // IRT theta
    $table->decimal('standard_error', 8, 4)->nullable(); // IRT SE
    $table->jsonb('adaptive_state')->nullable();       // Minimal state
    $table->timestamps();
    $table->softDeletes();
});
```

## Derivable Data

Everything else can be calculated:
- **Current question**: `responses()->whereNotNull('user_answer')->count()`
- **Domains tested**: `responses()->...->pluck('domain_id')->unique()`
- **Phase progress**: Calculate from domain responses
- **Domain performance**: GROUP BY responses

## Benefits

1. **From 21 to 11 columns** - 48% reduction
2. **No synchronization issues** - Everything derived from source
3. **Simpler code** - No state management needed
4. **Better performance** - Fewer updates per answer
5. **Data integrity** - Single source of truth

## IRT Parameters Location

```php
// In diagnostic_items table (correct location)
$table->decimal('irt_a', 4, 2);  // Discrimination
$table->decimal('irt_b', 4, 2);  // Difficulty  
$table->decimal('irt_c', 4, 2);  // Guessing
```

## Minimal Adaptive State

```json
{
  "domain_bloom_levels": {"1": 3, "2": 4},
  "domain_streaks": {"1": {"correct": 2, "incorrect": 0}}
}
```

Only store what can't be derived!