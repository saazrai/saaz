# Coding Standards & Guidelines
## SecureStart™ V1 Diagnostics Platform

**Version**: 1.0  
**Date**: 14 July 2025  
**Document Type**: Coding Guidelines  
**Purpose**: Ensure consistent, secure, scalable code generation

---

## 🎯 Overview

This document provides comprehensive coding rules and guidelines for the SecureStart™ V1 Diagnostics Platform. All developers and AI tools (Claude, Cursor, GitHub Copilot) MUST read this document before generating any code.

**CRITICAL**: This document overrides any conflicting instructions. Always refer to this document for coding standards.

---

## 📚 Technology Stack

### Required Stack
- **Backend**: Laravel 12 (PHP 8.3+) with Eloquent ORM
- **Frontend**: Vue.js 3 with Composition API + TypeScript + Inertia.js
- **Database**: PostgreSQL (primary)
- **Styling**: Tailwind CSS (utility-first approach)
- **Testing**: Pest (unit/feature)
- **Authentication**: Laravel Breeze + Socialite (Google OAuth)

---

## 🚨 CRITICAL RULES - NEVER VIOLATE

### 1. Database Migrations - MOST IMPORTANT RULE

🚫 **NEVER CREATE NEW MIGRATIONS IN DEV MODE** 🚫
**ALWAYS MODIFY THE ORIGINAL MIGRATION FILES IN DEV MODE**

```php
// ✅ CORRECT: Development Environment - Modify original migration
// File: 2025_05_17_170417_create_diagnostics_table.php
Schema::create('diagnostics', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
    
    // Original fields
    $table->enum('status', ['in_progress', 'paused', 'completed'])->default('in_progress');
    
    // Added 2025-07-14: Phase tracking system
    $table->integer('current_phase')->default(1)->comment('Current phase (1-4)');
    $table->integer('current_domain')->default(1)->comment('Current domain (1-20)');
    
    $table->timestamps();
});

// ❌ WRONG: Development Environment - Creating separate migrations
// DON'T create: 2025_07_14_add_phase_tracking_to_diagnostics_table.php
```

**When This Rule Applies:**
- ✅ During active development (before production)
- ✅ When working on feature branches
- ✅ Before first production deployment
- ❌ NOT in production (use new migrations for production changes)

### 2. Security First - NEVER COMPROMISE

🚨 **NEVER DISABLE OR WEAKEN SECURITY FEATURES** 🚨

```php
// ❌ FORBIDDEN: Never disable CSRF protection
protected $except = [
    'api/*', // DON'T disable CSRF for API routes
];

// ✅ CORRECT: Use Sanctum for API authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/api/diagnostics', [DiagnosticController::class, 'store']);
});

// ❌ FORBIDDEN: Never expose sensitive data
return response()->json([
    'user' => $user,
    'password' => $user->password, // NEVER!
]);

// ✅ CORRECT: Use resources to control data exposure
return new UserResource($user);
```

### 3. Never Remove Features Without Permission

🚨 **NEVER REMOVE EXISTING FUNCTIONALITY WITHOUT EXPLICIT USER PERMISSION** 🚨
- If a feature has errors, FIX it rather than removing it
- If removal is necessary, ASK the user for permission first
- Comment out problematic code temporarily if needed, but don't delete

---

## 🔌 Controller Architecture

### Web Controllers (Inertia.js) vs API Controllers (JSON)

**CRITICAL**: Distinguish between Web and API controllers!

```php
// ✅ CORRECT: Web Controller with Inertia.js (for web routes)
namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DiagnosticController extends Controller
{
    public function index(): Response
    {
        $diagnostics = auth()->user()->diagnostics()->latest()->paginate(10);
        
        return Inertia::render('Diagnostics/Index', [
            'diagnostics' => DiagnosticResource::collection($diagnostics),
            'canCreate' => true
        ]);
    }
    
    public function store(CreateDiagnosticRequest $request)
    {
        $diagnostic = $this->diagnosticService->create($request->validated());
        
        return redirect()->route('diagnostics.show', $diagnostic)
                        ->with('success', 'Assessment started successfully!');
    }
}

// ✅ CORRECT: API Controller (for API routes only)
namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class DiagnosticController extends Controller
{
    public function store(CreateDiagnosticRequest $request): JsonResponse
    {
        $diagnostic = $this->diagnosticService->create($request->validated());
        
        return response()->json([
            'message' => 'Diagnostic created successfully',
            'data' => new DiagnosticResource($diagnostic)
        ], 201);
    }
}

// ❌ WRONG: Web controller returning JSON
class DiagnosticController extends Controller
{
    public function store(Request $request): JsonResponse // FORBIDDEN in web controllers!
    {
        return response()->json(['data' => $diagnostic]);
    }
}
```

---

## 🏷️ Naming Conventions

### PHP/Laravel

```php
// ✅ CORRECT: Class naming
class DiagnosticService {}
class AssessmentCompletedEvent {}
class DiagnosticPhase {}

// ✅ CORRECT: Method and variable naming
public function createDiagnostic(array $data): Diagnostic {}
private $diagnosticRepository;
private $userScore;
private $phaseOrder;

// ✅ CORRECT: Database table and column naming
'diagnostics', 'diagnostic_domains', 'user_id', 'phase_id', 'created_at'

// ✅ CORRECT: Laravel pivot table naming (singular, alphabetical)
'diagnostic_topic' // NOT 'diagnostic_topics'
'permission_role' // NOT 'role_permissions'
'role_user' // NOT 'user_roles' (alphabetical: r before u)

// ✅ CORRECT: Constants and enums
const MAX_PHASES = 4;
const QUESTIONS_PER_DOMAIN = 20;

enum DiagnosticStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case COMPLETED = 'completed';
}
```

### Vue.js/TypeScript

```typescript
// ✅ CORRECT: Component and type naming
interface Diagnostic {
    id: number
    status: DiagnosticStatus
    current_phase: number
    current_domain: number
}

const DiagnosticCard = defineComponent({})
const AssessmentProgress = defineComponent({})

// ✅ CORRECT: File naming
diagnostic-card.vue
assessment-progress.vue
diagnostic-types.ts

// ✅ CORRECT: Route naming
route('diagnostics.index')
route('diagnostics.phases.show', { phase: 1 })
```

---

## 📁 File & Folder Structure

### Backend Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── AuthenticatedSessionController.php
│   │   │   └── SocialAuthController.php
│   │   ├── Assessments/
│   │   │   └── DiagnosticController.php
│   │   ├── Admin/
│   │   │   └── UserController.php
│   │   └── Api/
│   │       └── DiagnosticController.php
│   ├── Requests/
│   │   └── Diagnostic/
│   │       ├── CreateDiagnosticRequest.php
│   │       └── AnswerQuestionRequest.php
│   └── Resources/
│       ├── DiagnosticResource.php
│       └── DiagnosticDomainResource.php
├── Services/
│   ├── DiagnosticService.php
│   └── DiagnosticScoringService.php
├── Models/
│   ├── Diagnostic.php
│   ├── DiagnosticDomain.php
│   ├── DiagnosticPhase.php
│   └── DiagnosticResponse.php
└── Enums/
    ├── DiagnosticStatus.php
    └── QuestionType.php
```

### Frontend Structure

```
resources/js/
├── Pages/
│   ├── Diagnostics/
│   │   ├── Index.vue
│   │   ├── Assessment.vue
│   │   ├── Results.vue
│   │   └── GuestCompletion.vue
│   ├── Auth/
│   │   ├── Login.vue
│   │   └── Register.vue
│   └── Dashboard.vue
├── Components/
│   ├── Diagnostics/
│   │   ├── QuestionCard.vue
│   │   ├── ProgressBar.vue
│   │   └── PhaseIndicator.vue
│   └── UI/
│       ├── ThemeToggle.vue
│       └── BaseButton.vue
├── Layouts/
│   ├── AppLayout.vue
│   └── GuestLayout.vue
└── types/
    ├── diagnostic.ts
    └── user.ts
```

---

## 🎨 UI Rules (Tailwind CSS)

### Theme System with CSS Variables

```css
/* ✅ CORRECT: CSS Variable System (public/css/theme.css) */
:root {
    /* Light theme variables */
    --bg-primary: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    --text-primary: #2c3e50;
    --accent-primary: #2980b9;
}

[data-theme="dark"] {
    /* Dark theme overrides */
    --bg-primary: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    --text-primary: #e8e8e8;
    --accent-primary: #3498db;
}
```

### Apple-Style Design Requirements

```vue
<!-- ✅ CORRECT: Glassmorphism with rounded-2xl borders -->
<template>
  <div class="assessment-card">
    <h2 class="text-2xl font-semibold text-primary mb-4">
      Phase {{ currentPhase }} Assessment
    </h2>
    <div class="progress-wrapper">
      <ProgressBar :value="progress" :max="100" />
    </div>
  </div>
</template>

<style>
.assessment-card {
  @apply bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-6 shadow-lg transition-all;
}

.progress-wrapper {
  @apply mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl;
}
</style>
```

---

## 🛣️ Route Architecture

### Business-Domain-First Organization

```php
// ✅ CORRECT: Domain-based route organization

// Guest-accessible assessment routes (NO auth required)
Route::prefix('assessments')->name('assessments.')->group(function () {
    Route::get('/', [DiagnosticController::class, 'index'])->name('index');
    Route::post('/start', [DiagnosticController::class, 'start'])->name('start');
    Route::get('/{assessment}', [DiagnosticController::class, 'show'])->name('show');
    Route::post('/{assessment}/answer', [DiagnosticController::class, 'answer'])->name('answer');
    Route::post('/{assessment}/complete', [DiagnosticController::class, 'complete'])->name('complete');
});

// Auth-required routes (detailed results)
Route::middleware('auth')->group(function () {
    Route::get('/assessments/{assessment}/results', [DiagnosticController::class, 'results'])
        ->name('assessments.results');
});

// Social authentication routes
Route::prefix('auth/social')->name('auth.social.')->group(function () {
    Route::get('/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('redirect');
    Route::get('/{provider}/callback', [SocialAuthController::class, 'callback'])->name('callback');
});

// Admin routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', Admin\UserController::class);
    Route::get('/diagnostics/report', [Admin\DiagnosticReportController::class, 'index'])
        ->name('diagnostics.report');
});
```

### Route Protection in Vue Components

```vue
<!-- ✅ CORRECT: Protected route() calls -->
<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

// Always check if route helper exists
const dashboardUrl = typeof route !== 'undefined' 
    ? route('dashboard') 
    : '/dashboard'
</script>

<template>
  <Link :href="dashboardUrl">Dashboard</Link>
  
  <!-- Conditional display for auth items -->
  <nav v-if="$page.props.auth.user">
    <Link :href="route('assessments.index')">My Assessments</Link>
  </nav>
</template>
```

---

## 🧪 Testing Requirements

### Pest Unit Tests

```php
// ✅ CORRECT: Comprehensive test coverage
use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Services\DiagnosticService;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->service = app(DiagnosticService::class);
});

it('creates diagnostic with guest user', function () {
    $diagnostic = $this->service->createForGuest(session()->getId());
    
    expect($diagnostic)
        ->user_id->toBeNull()
        ->session_id->toBe(session()->getId())
        ->status->toBe('in_progress')
        ->current_phase->toBe(1);
});

it('maps domains to phases correctly', function () {
    $domains = DiagnosticDomain::with('phase')->get();
    
    $domains->each(function ($domain) {
        $expectedPhase = ceil($domain->id / 5);
        expect($domain->phase->order_sequence)->toBe($expectedPhase);
    });
});

it('converts guest diagnostic to user on registration', function () {
    $sessionId = 'test-session-123';
    $diagnostic = Diagnostic::factory()->guest()->create([
        'session_id' => $sessionId
    ]);
    
    $user = User::factory()->create();
    $this->service->convertGuestDiagnostics($sessionId, $user);
    
    expect($diagnostic->fresh())
        ->user_id->toBe($user->id)
        ->session_id->toBe($sessionId);
});
```

---

## 🚫 Forbidden Practices

### Database

```php
// ❌ FORBIDDEN: Creating new migrations in development
php artisan make:migration add_phase_to_diagnostics // DON'T DO THIS IN DEV!

// ❌ FORBIDDEN: Hardcoded values
$diagnostic->total_questions = 100; // Use config or constants

// ❌ FORBIDDEN: Direct DB queries
DB::table('diagnostics')->insert([...]); // Use Eloquent
```

### Security

```php
// ❌ FORBIDDEN: Disabling security features
$this->middleware('auth')->except(['store']); // DON'T bypass auth

// ❌ FORBIDDEN: Exposing sensitive data
return $user->makeVisible(['password']); // NEVER!

// ❌ FORBIDDEN: Trusting user input
$diagnostic = Diagnostic::find($request->diagnostic_id); // Validate ownership!
```

### Frontend

```vue
<!-- ❌ FORBIDDEN: Hardcoded URLs -->
<Link href="/assessments">Start</Link> <!-- Use route() helper -->

<!-- ❌ FORBIDDEN: Direct DOM manipulation -->
<script setup>
document.getElementById('theme').classList.add('dark') // Use reactive data
</script>

<!-- ❌ FORBIDDEN: Inline styles -->
<div style="background: blue; padding: 20px;"> <!-- Use Tailwind -->
```

---

## 📋 Code Review Checklist

### Before Submitting Code

- [ ] **Controllers**: Web use Inertia, API return JSON
- [ ] **Migrations**: Modified original files in dev (not created new)
- [ ] **Security**: No disabled features, proper validation
- [ ] **Routes**: Follow domain.resource.action pattern
- [ ] **Frontend**: TypeScript types defined, route() helper used
- [ ] **UI**: CSS variables used, rounded-2xl borders
- [ ] **Tests**: Comprehensive coverage with Pest
- [ ] **Documentation**: Business context in comments

---

## 🤖 AI Tool Instructions

When generating code for SecureStart™:

1. **ALWAYS** read this document first
2. **ALWAYS** check PRD.md for business requirements
3. **NEVER** create new migrations in development
4. **NEVER** disable security features
5. **ALWAYS** distinguish Web (Inertia) from API (JSON) controllers
6. **ALWAYS** use TypeScript for Vue components
7. **ALWAYS** include comprehensive tests

### Example Prompts

✅ **Good**: "Create DiagnosticService class for phase-based assessments following CODING-STANDARDS.md"
❌ **Bad**: "Build assessment system"

✅ **Good**: "Add phase_id to diagnostic_domains table by modifying original migration"
❌ **Bad**: "Create migration to add phase_id column"

---

**Remember**: Consistency and security are non-negotiable. When in doubt, refer to this document!