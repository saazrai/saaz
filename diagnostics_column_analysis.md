# Diagnostics Table Column Analysis

## Overview
Analysis of each column in the diagnostics table to determine usage and whether it can be removed.

## Column Analysis

### ✅ ACTIVELY USED COLUMNS

1. **id** - Primary key (REQUIRED)
2. **user_id** - Foreign key to users table (REQUIRED)
3. **status** - Used throughout the codebase for workflow control
4. **total_questions** - Set during initialization, used for progress tracking
5. **current_question** - Incremented after each answer, used for progress
6. **total_duration_seconds** - Used in results display and analytics
7. **score** - Calculated and displayed in results, used in dashboard
8. **current_phase** - Used for phase navigation (legacy but still active)
9. **current_phase_id** - New field for phase reference (actively used)
10. **target_phases** - Used to determine which phases to complete
11. **phases_completed** - Tracks completed phases
12. **domains_completed** - Tracks completed domains
13. **phase_completion_times** - Stores timestamps when phases are completed
14. **domain_progress** - Used in getPhaseProgress() method
15. **adaptive_state** - Core field for adaptive testing algorithm
16. **created_at/updated_at** - Laravel timestamps (REQUIRED)
17. **deleted_at** - Soft deletes (REQUIRED)

### ⚠️ MINIMALLY USED COLUMNS

1. **ability** - IRT theta parameter
   - Not found in active code usage
   - Appears to be planned for future IRT implementation
   - Currently NULL in most records

2. **standard_error** - Standard error of ability estimate
   - Not found in active code usage
   - Related to IRT implementation
   - Currently NULL in most records

3. **current_domain** - Legacy field
   - Still set in some places but marked as "legacy field for backward compatibility"
   - Being replaced by phase-based navigation
   - Could be removed after full migration

4. **phase_progress** - JSON field
   - Only referenced once in DiagnosticPhase.php
   - Not in the fillable array of Diagnostic model
   - Appears to be unused/abandoned

## Recommendations

### Safe to Remove:
1. **phase_progress** - Not in fillable array, minimal usage
2. **ability** - No active usage, IRT not implemented
3. **standard_error** - No active usage, IRT not implemented

### Consider Removing (with migration):
1. **current_domain** - Legacy field, being replaced by phase system
   - Would need to update code that still sets this field
   - Replace with phase-based domain tracking

### Must Keep:
- All other columns are actively used and required for current functionality

## Migration Steps if Removing Columns

1. Create a migration to drop unused columns
2. Remove from $fillable array in Diagnostic model
3. Remove from $casts array if applicable
4. Search and remove any remaining references in code
5. Update any tests that reference these columns

## Code References

### phase_progress usage:
- Only in `app/Models/DiagnosticPhase.php:100`

### ability/standard_error:
- Only in migration file, not used in application code

### current_domain:
- Set in `DiagnosticController.php` lines 108, 195, 266
- Marked as "Legacy field for backward compatibility"