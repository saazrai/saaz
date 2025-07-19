<?php

use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Legal\PrivacyController;
use App\Http\Controllers\Assessments\DiagnosticController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index', [
        'user' => auth()->user(),
    ]);
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Static pages
Route::get('/about', fn() => Inertia::render('About'))->name('info.about');

// Public sample diagnostic (no auth required)
Route::get('/diagnostics/sample', [DiagnosticController::class, 'sample'])->name('assessments.diagnostics.sample');

// Legal pages
Route::get('/privacy', [PrivacyController::class, 'policy'])->name('privacy.policy');
Route::get('/privacy/consent', [PrivacyController::class, 'showConsent'])->middleware('auth')->name('privacy.consent');
Route::post('/privacy/consent', [PrivacyController::class, 'storeConsent'])->middleware('auth')->name('privacy.consent.store');
Route::get('/privacy/settings', [PrivacyController::class, 'settings'])->middleware('auth')->name('privacy.settings');
Route::get('/terms', [PrivacyController::class, 'terms'])->name('terms');
Route::get('/cookies', [PrivacyController::class, 'cookies'])->name('cookies');

// Cookie consent routes - ensure session is started
Route::prefix('legal/privacy')->middleware(['web'])->group(function () {
    Route::get('/cookie-consent-status', [PrivacyController::class, 'getConsentStatus']);
    Route::post('/cookie-consent', [PrivacyController::class, 'storeCookieConsent']);
});

// Diagnostics routes (mixed public/auth)
Route::prefix('diagnostics')->name('assessments.diagnostics.')->group(function () {
    // Public routes (no auth required)
    Route::get('/', [DiagnosticController::class, 'index'])->name('index');
    
    // Protected routes (require authentication)
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/results', [DiagnosticController::class, 'allResults'])->name('all-results');
        Route::get('/start', [DiagnosticController::class, 'start'])->name('start');
        Route::post('/begin', [DiagnosticController::class, 'begin'])->name('begin');
        Route::post('/store', [DiagnosticController::class, 'store'])->name('store');
        Route::get('/{diagnostic}', [DiagnosticController::class, 'show'])->name('show');
        Route::post('/{diagnostic}/answer', [DiagnosticController::class, 'answer'])->name('answer');
        Route::post('/{diagnostic}/submit', [DiagnosticController::class, 'submit'])->name('submit');
        Route::get('/{diagnostic}/results', [DiagnosticController::class, 'results'])->name('results');
        Route::get('/{diagnostic}/report', [DiagnosticController::class, 'report'])->name('report');
        Route::get('/{diagnostic}/phase/{phase}/results', [DiagnosticController::class, 'phaseResults'])->name('phase-results');
        Route::post('/{diagnostic}/continue-phase', [DiagnosticController::class, 'continuePhase'])->name('continue-phase');
    });
});

// Admin routes (require admin permissions)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Audit logs (for compliance and debugging)
    Route::get('audits', [AuditController::class, 'index'])->name('audits.index');
    Route::get('audits/{audit}', [AuditController::class, 'show'])->name('audits.show');
    Route::post('audits/export', [AuditController::class, 'export'])->name('audits.export');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
