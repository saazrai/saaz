# Diagnostic Analysis Commands

These commands help you analyze diagnostic assessments to understand why they take many questions and how the adaptive algorithm behaves.

## Quick Start

```bash
# List all diagnostics
php artisan diagnostic:list

# Analyze a specific diagnostic (e.g., ID 1)
php artisan diagnostic:summary 1

# Get help on all diagnostic commands
php artisan diagnostic:help
```

## Available Commands

### diagnostic:list
Lists recent diagnostic assessments with basic statistics.

```bash
# Basic usage
php artisan diagnostic:list

# Filter by user
php artisan diagnostic:list --user=5

# Filter by status
php artisan diagnostic:list --status=completed

# Show more results
php artisan diagnostic:list --recent=20

# Combine filters
php artisan diagnostic:list --user=5 --status=completed --recent=50
```

### diagnostic:summary
Provides detailed analysis of why a diagnostic took many questions.

```bash
# Analyze diagnostic ID 1
php artisan diagnostic:summary 1

# Show help
php artisan diagnostic:summary
```

This command shows:
- Basic information (user, status, duration, score)
- Performance analysis (accuracy, correct/incorrect counts)
- Response time analysis
- Accuracy progression by 10-question chunks
- Consecutive incorrect answer patterns
- Reasons why the assessment took many questions
- Recommendations for improvement

### diagnostic:help
Shows comprehensive help for all diagnostic commands.

```bash
php artisan diagnostic:help
```

## Understanding the Results

### Key Metrics

- **Confidence %**: How confident the system is in its assessment of your knowledge level
- **Completion %**: Progress through the estimated total questions needed
- **Accuracy %**: Percentage of correct answers
- **Question Count**: Total questions answered (maximum is typically 100)

### Why Assessments Take Many Questions

1. **Mixed Performance (40-70% accuracy)**
   - Too high to conclude you don't know the material
   - Too low to confirm mastery
   - System continues testing to find your true level

2. **High Variance in Performance**
   - Inconsistent accuracy between question chunks
   - Algorithm can't establish stable difficulty level

3. **Multiple Domains**
   - Each domain requires minimum coverage (typically 5 questions)
   - More domains = more questions needed

4. **Consecutive Incorrect Answers**
   - Triggers difficulty recalibration
   - System tries to find appropriate level

5. **Multi-Phase Assessments**
   - Each phase requires minimum questions
   - Cannot skip phases even with good performance

## Example Analysis

```bash
$ php artisan diagnostic:summary 1

=== DIAGNOSTIC SUMMARY FOR ID 1 ===

BASIC INFORMATION:
User: John Doe
Status: Completed
Total Questions: 100
Score: 50%
Duration: 01:23:45

PERFORMANCE ANALYSIS:
Correct Answers: 50
Incorrect Answers: 50
Overall Accuracy: 50%

ACCURACY PROGRESSION (by 10-question chunks):
Questions 1-10: 10% accuracy (1/10 correct)
Questions 11-20: 40% accuracy (4/10 correct)
Questions 21-30: 70% accuracy (7/10 correct)
[...]

WHY DID THIS ASSESSMENT TAKE 100 QUESTIONS?
✅ Reached maximum question limit (100)
• Mixed performance (50% accuracy) - too high to stop early, too low for mastery
• Had 8 consecutive incorrect answers - indicates difficulty calibration issues
• Unstable performance (variance: 70%) - inconsistent results prevent early termination
```

## Tips for Faster Assessments

1. **Maintain Consistent Performance**
   - Avoid guessing when unsure
   - Take breaks if fatigued

2. **Focus on Specific Domains**
   - Request domain-specific assessments
   - Master one area before moving to another

3. **Review Before Assessment**
   - Better preparation leads to more stable performance
   - Reduces variance in accuracy

## Troubleshooting

### Command Not Found
```bash
# Make sure you're in the project directory
cd /path/to/your/project

# Clear cache if needed
php artisan cache:clear
```

### No Diagnostics Found
- Check if diagnostics exist in the database
- Verify user ID if using filters
- Check status filter spelling (completed, in_progress, paused)

### Large Question Counts
- Use `diagnostic:summary` to understand why
- Look for high variance in accuracy
- Check for consecutive incorrect streaks
- Review if algorithm is properly configured