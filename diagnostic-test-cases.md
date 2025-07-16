# How to Test Diagnostic Cases Manually

## Using the Diagnostic Test Command

Run specific test cases with:
```bash
php artisan diagnostic:test --case=1
```

List all test cases:
```bash
php artisan diagnostic:test --list
```

## Using the Regular Bot with Strategies

### Test Case 1: Straight Expert Path (L5.0)
```bash
php artisan diagnostic:bot --strategy=always-correct --details
```

### Test Case 2: Straight Beginner Path (L1.0)
```bash
php artisan diagnostic:bot --strategy=always-wrong --details
```

### Test Case 4: Standard Advancement (66.67%)
```bash
php artisan diagnostic:bot --strategy=mixed --accuracy=67 --details
```

### Test Case 5: Quick Drop (25% accuracy)
```bash
php artisan diagnostic:bot --strategy=mixed --accuracy=25 --details
```

### Test Case 9: Near Miss Expert (85% accuracy)
```bash
php artisan diagnostic:bot --strategy=mixed --accuracy=85 --details
```

## Understanding the Output

When you run the bot, look for:

1. **Question Pattern**: Shows each question with domain, level, and result (✓/✗)
2. **Domain Breakdown**: Summary table showing performance per domain
3. **Proficiency Levels**: Final proficiency level for each domain tested

Example output:
```
Q1: Privacy (L3) - ✓ | Overall: 100%
Q2: Privacy (L3) - ✓ | Overall: 100%
Q3: Privacy (L4) - ✓ | Overall: 100%
...

Proficiency Levels:
  Privacy: 5.0 - Expert
  General Security Concepts: 4.5 - Advanced+
```

## Tips for Testing

1. **Use --details flag**: Shows each question as it's answered
2. **Check proficiency levels**: Verify they match expected outcomes
3. **Look for patterns**: The bot shows progression like ✓✓✗✓
4. **Run analysis**: After each test, run `php artisan diagnostic:analyze {id}`

## Domain Rotation

The system uses hybrid round-robin strategy:
- Tests multiple domains in rotation
- Each domain gets minimum 4 questions
- Focus on one domain by answering consistently well/poorly

## Expected Outcomes by Test Case

| Case | Pattern | Expected Result |
|------|---------|-----------------|
| 1 | All correct | L5.0 (Expert) |
| 2 | All wrong | L1.0 (Beginner) |
| 3 | L3 fail, L2 stable | L2.5 (Foundational+) |
| 4 | 67% at each level | L5.0 (Expert) |
| 5 | Quick regression | L1.5 (Beginner+) |
| 6 | Recovery to L3 | L3.0 (Competent) |
| 7 | Plateau at L2 | L2.5 (Foundational+) |
| 8 | L3 perfect, L4 fail | L3.5 (Competent+) |
| 9 | L4 perfect, L5 fail | L4.5 (Advanced+) |
| 10 | L1 proven, L2 fail | L1.5 (Beginner+) |