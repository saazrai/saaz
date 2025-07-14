# SecureStart™ V1 - Fresh Project Setup Guide

## 🚀 Laravel 12 + Vue.js Setup Steps

### **Prerequisites**
```bash
# Verify versions
php --version    # Should be PHP 8.3+
node --version   # Should be Node 18+
npm --version    # Should be npm 9+
composer --version
```

## 📁 **Step 1: Create Fresh Laravel 12 Project**

```bash
# Navigate to your projects directory
cd ~/Sites  # or wherever you keep projects

# Create new Laravel 12 project
composer create-project laravel/laravel securestart-v1

# Navigate to project
cd securestart-v1

# Verify Laravel version
php artisan --version  # Should show Laravel Framework 12.x
```

## 🔧 **Step 2: Install Core Dependencies**

```bash
# Laravel packages
composer require laravel/breeze laravel/socialite inertiajs/inertia-laravel tightenco/ziggy

# Development packages
composer require --dev laravel/telescope pestphp/pest pestphp/pest-plugin-laravel

# Frontend dependencies
npm install

# Additional frontend packages
npm install @tailwindcss/forms @tailwindcss/typography @types/node
```

## 🔐 **Step 3: Setup Authentication (Breeze + Vue + TypeScript)**

```bash
# Install Breeze with Vue and TypeScript
php artisan breeze:install vue --typescript

# Install npm dependencies
npm install

# Build assets
npm run build
```

## 🗄️ **Step 4: Database Configuration**

### **Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **Update .env file**
```env
APP_NAME="SecureStart Academy"
APP_ENV=local
APP_KEY=base64:xxxxx
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=sqlite
# For SQLite (simpler for development)
DB_DATABASE=/absolute/path/to/securestart-v1/database/database.sqlite

# OR for PostgreSQL (production-ready)
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=securestart_v1
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Google OAuth (get from Google Console)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/social/google/callback"
```

### **Create Database**
```bash
# For SQLite
touch database/database.sqlite

# Run initial migrations
php artisan migrate
```

## 🎨 **Step 5: Extract Theme System from Current Project**

```bash
# Create CSS directory
mkdir -p public/css

# Copy theme system from current project
cp ../academy/public/css/theme.css public/css/theme.css
```

### **Update app.blade.php to include theme CSS**
```php
<!-- resources/views/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
```

## 📊 **Step 6: Create V1 Database Migrations**

### **Assessment Tables**
```bash
# Create assessment-related migrations
php artisan make:migration create_assessment_questions_table
php artisan make:migration create_assessments_table
php artisan make:migration create_assessment_responses_table
php artisan make:migration create_assessment_results_table
```

### **Assessment Questions Migration**
```php
<?php
// database/migrations/xxxx_create_assessment_questions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->string('domain'); // CISSP domains
            $table->text('question_text');
            $table->json('options'); // Multiple choice options
            $table->integer('correct_answer'); // Index of correct option
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced']);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['domain', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_questions');
    }
};
```

### **Assessments Migration (Guest-Friendly)**
```php
<?php
// database/migrations/xxxx_create_assessments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // NULLABLE for guests
            $table->string('session_id'); // Track guests before registration
            $table->enum('status', ['started', 'completed', 'abandoned'])->default('started');
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->json('metadata')->nullable(); // Store additional data
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['session_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
```

### **Assessment Responses Migration**
```php
<?php
// database/migrations/xxxx_create_assessment_responses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('assessment_question_id')->constrained()->onDelete('cascade');
            $table->integer('selected_answer'); // Index of selected option
            $table->boolean('is_correct');
            $table->timestamp('answered_at');
            $table->timestamps();
            
            $table->unique(['assessment_id', 'assessment_question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_responses');
    }
};
```

### **Assessment Results Migration**
```php
<?php
// database/migrations/xxxx_create_assessment_results_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->decimal('overall_score', 5, 2); // Percentage score
            $table->json('domain_scores'); // Scores by CISSP domain
            $table->json('recommendations')->nullable(); // Improvement suggestions
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_results');
    }
};
```

## 🔗 **Step 7: Configure Google OAuth**

### **Add to config/services.php**
```php
// config/services.php
return [
    // ... existing services

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],
];
```

### **Update User Migration for Social Auth**
```php
// database/migrations/xxxx_create_users_table.php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password')->nullable(); // Nullable for social auth users
    
    // Social auth fields
    $table->string('google_id')->nullable()->unique();
    $table->string('avatar')->nullable();
    
    $table->rememberToken();
    $table->timestamps();
});
```

## 🏗️ **Step 8: Create Core Models**

### **User Model Update**
```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
```

### **Assessment Model**
```bash
php artisan make:model Assessment
```

```php
<?php
// app/Models/Assessment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'status',
        'started_at',
        'completed_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(AssessmentResponse::class);
    }

    public function result(): HasOne
    {
        return $this->hasOne(AssessmentResult::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForGuest($query, string $sessionId)
    {
        return $query->where('session_id', $sessionId)->whereNull('user_id');
    }
}
```

### **Other Models**
```bash
php artisan make:model AssessmentQuestion
php artisan make:model AssessmentResponse  
php artisan make:model AssessmentResult
```

## 🛣️ **Step 9: Setup V1 Routes**

### **Create routes/web.php**
```php
<?php
// routes/web.php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| V1 SecureStart™ Routes - Diagnostic Assessment Platform
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Guest-accessible assessment routes (NO auth required)
Route::prefix('assessments')->name('assessments.')->group(function () {
    Route::get('/', [AssessmentController::class, 'index'])->name('index');
    Route::post('/start', [AssessmentController::class, 'start'])->name('start');
    Route::get('/{assessment}', [AssessmentController::class, 'show'])->name('show');
    Route::post('/{assessment}/answer', [AssessmentController::class, 'answer'])->name('answer');
    Route::post('/{assessment}/complete', [AssessmentController::class, 'complete'])->name('complete');
});

// Social authentication routes
Route::prefix('auth/social')->name('auth.social.')->group(function () {
    Route::get('/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('redirect');
    Route::get('/{provider}/callback', [SocialAuthController::class, 'callback'])->name('callback');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Assessment results (require authentication)
    Route::get('/assessments/{assessment}/results', [AssessmentController::class, 'results'])->name('assessments.results');
    
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Breeze auth routes
require __DIR__.'/auth.php';
```

## 🎮 **Step 10: Create Core Controllers**

### **Assessment Controller**
```bash
php artisan make:controller AssessmentController
```

### **Social Auth Controller**
```bash
php artisan make:controller Auth/SocialAuthController
```

```php
<?php
// app/Http/Controllers/Auth/SocialAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        if (!in_array($provider, ['google'])) {
            return redirect()->route('login')->with('error', 'Invalid social provider.');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            $user = User::updateOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName(),
                'google_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
            ]);

            Auth::login($user);

            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
```

## 🎨 **Step 11: Setup Vue.js Components Structure**

### **Create component directories**
```bash
mkdir -p resources/js/Components/Assessment
mkdir -p resources/js/Components/UI
mkdir -p resources/js/Pages/Assessment
mkdir -p resources/js/Pages/Dashboard
```

### **Create Theme Toggle Component**
```vue
<!-- resources/js/Components/UI/ThemeToggle.vue -->
<template>
    <div class="theme-toggle">
        <span class="theme-icon sun">☀️</span>
        <button 
            @click="toggleTheme"
            class="theme-switch"
            :class="{ active: isDark }"
            aria-label="Toggle theme"
        />
        <span class="theme-icon moon">🌙</span>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'

const isDark = ref(false)

const toggleTheme = () => {
    isDark.value = !isDark.value
    const theme = isDark.value ? 'dark' : 'light'
    document.documentElement.setAttribute('data-theme', theme)
    localStorage.setItem('theme', theme)
}

onMounted(() => {
    const savedTheme = localStorage.getItem('theme') || 'light'
    isDark.value = savedTheme === 'dark'
    document.documentElement.setAttribute('data-theme', savedTheme)
})
</script>
```

## 🏃‍♂️ **Step 12: Run Initial Setup**

```bash
# Run migrations
php artisan migrate

# Install Telescope (optional, for debugging)
php artisan telescope:install
php artisan migrate

# Build assets
npm run dev

# Start development server
php artisan serve
```

## ✅ **Step 13: Verify Setup**

Visit these URLs to verify everything works:
- `http://localhost:8000` - Landing page
- `http://localhost:8000/login` - Login page
- `http://localhost:8000/register` - Registration page
- `http://localhost:8000/assessments` - Assessment index

## 🎯 **Next Steps After Setup**

1. **Create assessment questions seeder**
2. **Build assessment flow components**
3. **Implement guest session tracking**
4. **Create results visualization**
5. **Add basic admin panel**

## 📋 **Setup Verification Checklist**

- [ ] Laravel 12 project created
- [ ] Breeze with Vue + TypeScript installed
- [ ] Database migrations created and run
- [ ] Google OAuth configured
- [ ] Theme system copied and integrated
- [ ] Core models created
- [ ] Routes defined
- [ ] Controllers scaffolded
- [ ] Vue components structure created
- [ ] Development server running

Your SecureStart™ V1 foundation is now ready for building the diagnostic assessment platform! 🚀