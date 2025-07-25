# Adaptive Diagnostics System - SecureStart™ V1

## Overview

Following Apple's design philosophy of "Simplicity is the ultimate sophistication", SecureStart™ implements a unified adaptive assessment system. The system intelligently adapts to each user's performance, providing accurate proficiency measurement across 20 security domains.

### Key Updates (December 2024)
- **Early Advancement**: 2/2 perfect score enables immediate level progression
- **Minimum Questions**: Reduced from 5 to 4 per domain
- **Plus (+) Levels**: 9-level scale recognizing advancement attempts
- **L5 Smart Ceiling Test**: 2-3 questions (3rd only if 50% performance)
- **Statistical Confidence**: All decisions require 2+ questions minimum
- **No Regression to Proven Levels**: If L3 proven with 75%+, no regression from L4

### Key Features
- **Linear Phase Progression**: 4 phases, 5 domains each (must complete in order)
- **Adaptive Algorithm**: Questions adapt based on performance
- **Time Estimate**: 15-45 minutes per phase
- **Smart Stopping**: Stops when confident in assessment
- **Warm-Start**: Returning users benefit from previous performance data

---

## Core Business Rules

```javascript
const ASSESSMENT_CONFIG = {
    // Question limits per domain
    MIN_QUESTIONS_PER_DOMAIN: 4,     // Minimum 4 questions (allows 2/3 advancement with room for next level)
    MAX_QUESTIONS_PER_DOMAIN: 12,    // Maximum questions per domain
    
    // Assessment parameters
    STARTING_BLOOM_LEVEL: 3,         // All domains start at L3 (Apply)
    CONFIDENCE_THRESHOLD: 0.85,      // Stop when this confident
    CEILING_ATTEMPTS: 3,             // Attempts at potential ceiling
    
    // Question pool per domain
    QUESTIONS_PER_DOMAIN: 50,        // Total questions available
    
    // Phase structure
    PHASES: 4,                       // Total phases
    DOMAINS_PER_PHASE: 5,           // Domains in each phase
};

// Question distribution per domain (50 questions total)
const BLOOM_DISTRIBUTION = {
    1: { count: 7,  percentage: 0.14 },  // Remember
    2: { count: 10, percentage: 0.20 },  // Understand
    3: { count: 16, percentage: 0.32 },  // Apply
    4: { count: 10, percentage: 0.20 },  // Analyze
    5: { count: 7,  percentage: 0.14 },  // Evaluate
    // Note: Bloom level 6 (Create) is not used
};
```

---

## Proficiency Level Definitions

```javascript
const PROFICIENCY_LEVELS = {
    5.0: { label: 'Expert',          requirement: '≥66.67% at Bloom 5 (2+ questions)' },
    4.5: { label: 'Advanced+',       requirement: 'Stable at L4, attempted but failed L5' },
    4.0: { label: 'Advanced',        requirement: 'Stable at Bloom 4, did not attempt L5' },
    3.5: { label: 'Competent+',      requirement: 'Stable at L3, attempted but failed L4' },
    3.0: { label: 'Competent',       requirement: 'Stable at Bloom 3, did not attempt L4' },
    2.5: { label: 'Foundational+',   requirement: 'Stable at L2, attempted but failed L3' },
    2.0: { label: 'Foundational',    requirement: 'Stable at Bloom 2, did not attempt L3' },
    1.5: { label: 'Beginner+',       requirement: 'Stable at L1, attempted but failed L2' },
    1.0: { label: 'Beginner',        requirement: 'Stable at Bloom 1, did not attempt L2' }
};

// Plus (+) Level Logic
// Plus levels are awarded when three conditions are met:
// 1. Stable at Base Level: User meets minimum performance threshold
// 2. Attempted Next Level: User was tested with 2+ questions at next level
// 3. Failed to Advance: User did not meet advancement threshold
```

---

## Phase Structure

### Phase 1: Foundation & Governance
1. General Security Concepts
2. Information Security Governance
3. Legal, Regulatory & Compliance
4. Privacy
5. Risk Management

### Phase 2: Technical Controls
6. Security Audits & Assessments
7. Threat & Vulnerability Management
8. Cryptography & Key Management
9. Data Governance
10. Access Control

### Phase 3: Infrastructure & Applications
11. Network & Communication Security
12. Application Security & DevSecOps
13. Cloud Security
14. Endpoint, Mobile & IoT Security
15. Security Architecture & Design

### Phase 4: Operations & Response
16. Security Awareness & Human Factors
17. Physical & Environmental Security
18. Security Operations & Monitoring
19. Incident Management & Forensics
20. Business Continuity & Disaster Recovery

---

## Adaptive Assessment Logic

### Starting a Domain
```php
function initializeDomain($domainId, $userId) {
    // Check for warm-start data
    $warmStartLevel = getWarmStartLevel($userId, $domainId);
    
    if ($warmStartLevel) {
        return $warmStartLevel; // Use previous performance
    }
    
    return 3; // Default: Start at Bloom Level 3 (Apply)
}
```

### Question Selection

#### Critical Design Principle: No Lower-Level Fallbacks
**"Test what you intend to test, or don't test at all."**

When testing for a specific Bloom level, the system MUST:
- Only use questions at the target level or higher
- Never substitute with easier (lower-level) questions
- Stop the domain test if appropriate questions unavailable

**Why this matters:**
- Each Bloom level tests fundamentally different cognitive abilities
- Lower-level questions cannot validate higher-level skills
- False positives corrupt the entire assessment validity

```php
function selectNextQuestion($domainId, $currentBloomLevel, $answeredQuestions) {
    // Get available questions at current Bloom level
    $availableQuestions = getQuestionsForDomainAndBloom($domainId, $currentBloomLevel);
    
    // Exclude already answered questions
    $availableQuestions = excludeAnswered($availableQuestions, $answeredQuestions);
    
    if (empty($availableQuestions)) {
        // CRITICAL: Do NOT fall back to lower levels
        // Options:
        // 1. Stop domain test (insufficient questions)
        // 2. Try higher level if appropriate (L3→L4)
        // NEVER: Use lower level questions (L3→L2)
        return null; // Signal to stop domain test
    }
    
    // Select randomly from available pool
    return selectRandom($availableQuestions);
}
```

### Bloom Level Progression
```php
// Dynamic thresholds based on cognitive complexity
const BLOOM_THRESHOLDS = [
    'advance' => [
        1 => 0.75,    // L1→L2: Need 75% (3/4)
        2 => 0.75,    // L2→L3: Need 75% (3/4)
        3 => 0.6667,  // L3→L4: Need 66.67% (2/3)
        4 => 0.6667,  // L4→L5: Need 66.67% (2/3)
        5 => 1.00,    // At L5: Need 100% to maintain
    ],
    'regress' => [
        1 => 0.00,    // Can't go below L1
        2 => 0.25,    // L2→L1: Below 25% (1/4)
        3 => 0.34,    // L3→L2: Below 34% (1/3)
        4 => 0.40,    // L4→L3: Below 40% (2/5)
        5 => 0.50,    // L5→L4: Below 50% (1/2)
    ]
];

// IMPORTANT: Early Advancement Rule
// - 2/2 perfect score at L1-L4 → Immediate advancement
// - Reduces questions for obvious cases by 33%
// - Ceiling test activates at L4 with 66.67%+ accuracy

// Statistical Confidence Requirements
// - All adaptations (advancement OR regression) require 2+ questions
// - No single-question regression allowed (e.g., 3✗✗→2, never 3✗→2)
// - Prioritizes statistical confidence over user experience
// - 84% confidence for decisions vs 67% with single questions
```

### Stopping Conditions
```php
function shouldStopDomainAssessment($state) {
    // 1. Minimum questions met (4 questions)
    if ($state['questions_asked'] < MIN_QUESTIONS_PER_DOMAIN) {
        return false;
    }
    
    // 2. L5 Smart Ceiling test
    if ($state['current_bloom'] == 5 && $state['questions_at_l5'] >= 2) {
        // Stop early if 100% or 0% after 2 questions
        if ($state['accuracy_at_l5'] == 1.0 || $state['accuracy_at_l5'] == 0.0) {
            return true; // Clear decision made
        }
        // Continue to 3rd if 50% (1/2)
        if ($state['questions_at_l5'] >= 3) {
            return true; // Maximum 3 questions at L5
        }
    }
    
    // 3. Ceiling confirmed (3+ failures at level)
    if ($state['consecutive_failures'] >= 3) {
        return true;
    }
    
    // 4. Floor confirmed (2+ questions at L1 with no advancement possible)
    if ($state['current_bloom'] == 1 && $state['questions_at_level'] >= 2) {
        $accuracy = $state['correct_at_level'] / $state['questions_at_level'];
        if ($accuracy < 0.75) { // Cannot advance from L1
            return true;
        }
    }
    
    // 5. Maximum questions reached
    if ($state['questions_asked'] >= MAX_QUESTIONS_PER_DOMAIN) {
        return true;
    }
    
    return false;
}
```

---

## User Flow

### 1. Assessment Start
- User must be authenticated (no guest diagnostics)
- System checks for previous assessments (warm-start)
- Begin with Phase 1, Domain 1

### 2. Phase Progression
- Complete all 5 domains in current phase
- See detailed phase results and analysis
- Option to continue to next phase or stop
- Must complete phases in order (1→2→3→4)

### 3. Domain Assessment
- Start at Bloom Level 3 (or warm-start level)
- 4-12 questions per domain (adaptive)
- Real-time progression based on performance
- Immediate domain-level results

### 4. Results & Analytics
- **Per Phase**: Detailed analysis of 5 domains
- **Progress**: Visual indicator (e.g., "Phase 2 of 4")
- **Insights**: Preliminary insights after each phase
- **History**: Separate page for trend analysis
- **Career Recommendations**: Only after all 4 phases complete

### 5. Retakes
- Unlimited retakes allowed
- Warm-start from previous performance
- Bot protection required
- Track best scores and full history

---

## Edge Cases & Validation

### Early Advancement Patterns (2/2 Perfect Score)
```
L1: ✓✓ → Advance to L2 (2/2 = 100%)
L2: ✓✓ → Advance to L3 (2/2 = 100%)
L3: ✓✓ → Advance to L4 (2/2 = 100%)
L4: ✓✓ → Advance to L5 (2/2 = 100%, triggers ceiling test)
```

### Standard Advancement Patterns (Meet Threshold)
```
L1: ✓✓✓✗ → Advance to L2 (3/4 = 75% ≥ 75%)
L2: ✓✓✓✗ → Advance to L3 (3/4 = 75% ≥ 75%)
L3: ✓✓✗ → Advance to L4 (2/3 = 66.67% ≥ 66.67%)
L4: ✓✓✗ → Advance to L5 (2/3 = 66.67% ≥ 66.67%)
```

### Regression Patterns (2+ Questions Required)
```
L2: ✗✗ → Regress to L1 (0/2 = 0% < 25%)
L3: ✗✓✗ → Regress to L2 (1/3 = 33.33% < 34%)
L4: ✗✗ → Regress to L3 (0/2 = 0% < 40%)
Note: No regression from L5 (ceiling test level)
```

### Ceiling Test (L5 Special Handling)
- Activation: 2+ questions at L4 with ≥66.67% accuracy (e.g., 2/3)
- L5 Smart Ceiling Test:
  - 2/2 correct (100%) → Stop, confirmed L5 Expert
  - 0/2 correct (0%) → Stop, confirmed L4+ (Advanced Plus)
  - 1/2 correct (50%) → Continue to 3rd question as tiebreaker
  - After 3rd question: ≥66.67% = L5, <66.67% = L4+
- **No regression from L5** - It's a ceiling test, not a progression level
- L5 Special Cases:
  - Never attempted L5 = Level 4 (Advanced)
  - No L5 questions available = Level 4+ (Advanced Plus) - capped by content

### Question Exhaustion Handling
When no questions are available at the target level:
- **Higher-level fallback allowed**: Testing L3 with L4 questions is valid
- **Lower-level fallback forbidden**: Testing L3 with L2 questions corrupts assessment
- **Domain stops immediately**: Better no data than invalid data
- **Proficiency capped**: User receives "plus" level (e.g., testing for L3, cap at L2+)

### Statistical Confidence
- All level changes require 2+ questions minimum
- Early advancement allowed with 2/2 perfect score
- No single-question decisions (advancement or regression)
- Prioritizes accuracy over speed

### Example Valid Progressions

**1. Perfect Expert (Minimal Path)**
```
Start: L3 → L3✓✓ → L4✓✓ → L5✓✓
Result: Level 5 (Expert)
Total: 6 questions (2/2 at L5 = 100%)
```

**2. Clear Beginner**
```
Start: L3 → L3✗✗ → L2✗✗ → L1✗✗
Result: Level 1.0 (Beginner)
Total: 6 questions
```

**3. Stable at L3**
```
Start: L3 → L3✓✗✓✗✓✗
Result: Level 3 (Competent)
Total: 6 questions (3/6 = 50%)
```

**4. Advanced Plus (Failed L5)**
```
Start: L3 → L3✓✓ → L4✓✓ → L5✗✗
Result: Level 4.5 (Advanced+)
Total: 6 questions (0/2 at L5)
```

**5. L5 Tiebreaker Needed**
```
Start: L3 → L3✓✓ → L4✓✓ → L5✓✗✓
Result: Level 5 (Expert)
Total: 7 questions (2/3 at L5 = 66.67%)
```

**6. Recovery Pattern**
```
Start: L3 → L3✗✗ → L2✓✓ → L3✗✓✗✓
Result: Level 3.0 (Competent)
Total: 8 questions
```

---

## Comprehensive Test Scenarios

### Core Progression Patterns
```
1. Straight Expert: L3✓✓ → L4✓✓ → L5✓✓ = L5.0
2. Standard Advancement: L3✓✗✓ → L4✓✗✓ → L5✓✗✓ = L5.0
3. Straight Beginner: L3✗✗ → L2✗✗ → L1✗✗ = L1.0
4. L1 Plus Level: L3✗✗ → L2✗✗ → L1✓✓ → L2✗✗ = L1.5
5. Multi-Regression: L3✗✗ → L2✗✗ → L1✗✓✗✓ = L1.5
6. L2 Plus: L3✗✓✗ → L2✓✗✓✗ = L2.5
7. L2 Plateau: L3✗✗ → L2✓✗✓✗ = L2.5
8. L3 Stable: L3✗✓✗✓ (4 questions, 50%) = L3.0
9. L3 Recovery: L3✗✗ → L2✓✓ → L3✗✓✗✓ = L3.0
10. L3 Plus: L3✓✓ → L4✗✗ = L3.5
11. L3 Plus Journey: L3✗✓✗ → L2✓✓ → L3✓✓ → L4✗✓✗ = L3.5
12. L4 Achieved: L3✗✗ → L2✓✓ → L3✓✓ → L4✓✗✓ = L4.0
13. L4 Plus: L3✓✓ → L4✓✓ → L5✗✗ = L4.5
14. Near Miss Expert: L3✓✓ → L4✓✓ → L5✓✗✗ = L4.5
```

### L5 Ceiling Test Scenarios
```
15. L5 Success: L3✓✓ → L4✓✓ → L5✓✗✓ (tiebreaker) = L5.0
16. L5 Failure: L3✓✓ → L4✓✓ → L5✓✗✗ (tiebreaker fail) = L4.5
17. L5 Smart Stop: L3✓✓ → L4✓✓ → L5✗✗ (stops at 2) = L4.5
```

### Warm-Start Scenarios
```
18. L1 Perfect Journey: Warm start at L1 → L1✓✓ → L2✓✓ → L3✓✓ → L4✓✓ → L5✓✓ = L5.0
19. L2 Warm Start: Warm start at L2 → L2✓✓ → L3✓✓ → L4✓✓ → L5✗✗ = L4.5
20. L4 Warm Start: Warm start at L4 → L4✓✓ → L5✓✗✓ = L5.0
```

### Edge Cases
```
21. No Regression Rule: L3✓✓ → L4✗✗ (no return to proven L3) = L3.5
22. Question Exhaustion: L3✓✓ → L4✓✓ → No L5 questions = L4.5
23. Domain Rotation: L3✗✓✗✓ → Next domain (4 questions at 50%) = L3.0
```

---

## Progress Calculation Logic

### Business Requirements

**Core Principle**: Progress is calculated domain-by-domain with each domain contributing equally to the total assessment progress.

```javascript
const PROGRESS_CONFIG = {
    DOMAINS_PER_PHASE: 5,           // Each phase has 5 domains
    DOMAIN_WEIGHT: 20,              // Each domain = 20% of total progress
    AVERAGE_QUESTIONS_PER_DOMAIN: 10, // Expected average questions
    QUESTION_VALUE: 2,              // Each question = 2% within domain
    DOMAIN_CAP: 18,                 // Cap progress at 18% until domain complete
    DOMAIN_COMPLETE: 20,            // Full 20% when domain stops/completes
};
```

### Per-Domain Progress Calculation

Each domain's progress is calculated independently:

```javascript
function calculateDomainProgress(domain) {
    const questionsAnswered = domain.questions_answered;
    const isDomainComplete = domain.is_complete; // From adaptive service
    
    if (isDomainComplete) {
        return 20; // Full domain weight when complete
    }
    
    // Cap at 18% to prevent showing 100% when domain isn't complete
    const progressFromQuestions = Math.min(18, questionsAnswered * 2);
    
    return progressFromQuestions;
}
```

### Total Progress Calculation

Total progress is the sum of all domain progress:

```javascript
function calculateTotalProgress(domains) {
    let totalProgress = 0;
    
    domains.forEach(domain => {
        totalProgress += calculateDomainProgress(domain);
    });
    
    return Math.round(totalProgress); // 0-100%
}
```

### Progress Examples

**Example 1: Early in Assessment**
- Domain 1: 3 questions answered, not complete → 6% (3 × 2%)
- Domain 2: 2 questions answered, not complete → 4% (2 × 2%)
- Domains 3-5: Not started → 0%
- **Total Progress: 10%**

**Example 2: One Domain Complete**
- Domain 1: Complete → 20%
- Domain 2: 5 questions answered, not complete → 10% (5 × 2%)
- Domain 3: 1 question answered, not complete → 2% (1 × 2%)
- Domains 4-5: Not started → 0%
- **Total Progress: 32%**

**Example 3: Domain with Many Questions**
- Domain 1: 12 questions answered, not complete → 18% (capped)
- Domain 2: Complete → 20%
- Domain 3: 4 questions answered, not complete → 8% (4 × 2%)
- Domains 4-5: Not started → 0%
- **Total Progress: 46%**

**Example 4: All Domains Complete**
- All 5 domains: Complete → 20% each
- **Total Progress: 100%**

### Implementation Requirements

#### Domain Progress Tracking
```php
// Track per domain in diagnostic_responses
function getDomainProgress($diagnosticId, $domainId) {
    $questionsAnswered = DiagnosticResponse::where('diagnostic_id', $diagnosticId)
        ->whereHas('diagnosticItem.subtopic.topic.domain', function($query) use ($domainId) {
            $query->where('id', $domainId);
        })
        ->whereNotNull('user_answer')
        ->count();
    
    $isDomainComplete = $this->adaptiveService->isDomainComplete($diagnosticId, $domainId);
    
    if ($isDomainComplete) {
        return 20;
    }
    
    return min(18, $questionsAnswered * 2);
}
```

#### Total Progress Calculation
```php
function calculateProgress($diagnostic) {
    $currentPhase = $diagnostic->phase;
    $totalProgress = 0;
    
    foreach ($currentPhase->domains as $domain) {
        $domainProgress = $this->getDomainProgress($diagnostic->id, $domain->id);
        $totalProgress += $domainProgress;
    }
    
    return round($totalProgress);
}
```

### Why This Design?

1. **Predictable & Fair**: Each domain contributes equally (20%) regardless of question count
2. **Mental Model**: Simple 5×20% = 100% calculation users can understand
3. **Prevents Gaming**: Can't rush through easy domains for quick progress
4. **18% Safety Cap**: Prevents misleading "100%" when domains aren't actually complete
5. **2% Per Question**: Provides meaningful incremental progress feedback

### Progress Jump Examples

When users see large progress jumps, it's because they've moved to a new domain:

- **Q2 → Q3**: From "General Security Concepts" (Domain 1) to "Information Security Governance" (Domain 2)
- **Jump**: ~10% because 2% for new question + ~8% credit for entering second domain
- **User sees**: 11% → 21% (perfectly normal behavior)

This large jump is **by design** - it rewards comprehensive assessment across all security domains rather than deep-diving into one area.

---

## Bot Protection

### Requirements
- CAPTCHA on assessment start
- Rate limiting (max 1 assessment per hour)
- Behavioral analysis (timing patterns)
- IP-based restrictions

### Implementation
```php
function validateAssessmentStart($userId, $request) {
    // Check rate limit
    if (hasRecentAssessment($userId, 60)) { // 60 minutes
        throw new RateLimitException();
    }
    
    // Verify CAPTCHA
    if (!verifyCaptcha($request->captcha_token)) {
        throw new InvalidCaptchaException();
    }
    
    // Check suspicious patterns
    if (detectBotBehavior($request)) {
        throw new BotDetectedException();
    }
    
    return true;
}
```

---

## Warm-Start Logic

```php
function getWarmStartLevel($userId, $domainId) {
    // Get recent profile (within 90 days)
    $profile = DiagnosticProfile::where('user_id', $userId)
        ->where('domain_id', $domainId)
        ->where('last_assessed_at', '>', now()->subDays(90))
        ->first();
    
    if (!$profile) {
        return null; // No warm-start data
    }
    
    // Apply time-based decay
    $daysSince = $profile->last_assessed_at->diffInDays(now());
    $decay = floor($daysSince / 180); // -1 level per 6 months
    
    // Calculate starting level with decay
    $startLevel = max(1, $profile->proficiency_level - $decay);
    $startLevel = min(4, $startLevel); // Cap at L4
    
    return $startLevel;
}
```

---

## Database Considerations

### Key Tables
- `diagnostics`: Main assessment sessions
- `diagnostic_responses`: Individual question responses
- `diagnostic_profiles`: User proficiency by domain
- `diagnostic_phases`: Phase completion tracking

### Performance Indexes
- `user_id, domain_id` on diagnostic_profiles
- `diagnostic_id, domain_id` on responses
- `user_id, phase_id, created_at` for history

---

## Testing Requirements

### Automated Bot Testing
- Test all 23 scenario patterns
- Validate edge cases
- Performance benchmarking
- Regression testing

### Manual Testing
- User experience flow
- Mobile responsiveness
- Results accuracy
- Career recommendation logic

---

## Future Enhancements (Post-V1)

1. **IRT Implementation**: When sufficient data collected
2. **Non-linear paths**: Skip phases based on expertise
3. **Micro-assessments**: Quick 5-minute skill checks
4. **Team assessments**: Organizational skill mapping
5. **API access**: Third-party integrations

---

This document serves as the complete specification for the SecureStart™ V1 Adaptive Diagnostics System.