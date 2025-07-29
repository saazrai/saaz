<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DiagnosticDomainController;
use App\Http\Controllers\Admin\System\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" and "admin" middleware groups.
|
*/

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Management
Route::resource('users', UserController::class);
Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');

// Permission Management
Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
Route::post('permissions/{permission}/assign-role', [\App\Http\Controllers\Admin\PermissionController::class, 'assignRole'])->name('permissions.assign-role');
Route::post('permissions/{permission}/revoke-role', [\App\Http\Controllers\Admin\PermissionController::class, 'revokeRole'])->name('permissions.revoke-role');

// Diagnostics Management (grouped under /admin/diagnostics prefix)
Route::prefix('diagnostics')->name('diagnostics.')->group(function () {
    // Diagnostic Phase Management
    Route::get('phases', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'index'])->name('phases.index');
    Route::get('phases/{diagnostic_phase}/edit', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'edit'])->name('phases.edit');
    Route::put('phases/{diagnostic_phase}', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'update'])->name('phases.update');
    Route::post('phases/{diagnostic_phase}/toggle-active', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'toggleActive'])->name('phases.toggle-active');
    Route::get('phases/domains/available', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'availableDomains'])->name('phases.domains.available');
    Route::post('phases/{diagnostic_phase}/assign-domains', [\App\Http\Controllers\Admin\DiagnosticPhaseController::class, 'assignDomains'])->name('phases.assign-domains');

    // Diagnostic Assessment Management
    Route::get('assessments', [\App\Http\Controllers\Admin\DiagnosticAssessmentController::class, 'index'])->name('assessments.index');
    Route::get('assessments/{diagnostic}', [\App\Http\Controllers\Admin\DiagnosticAssessmentController::class, 'show'])->name('assessments.show');
    Route::post('assessments/export', [\App\Http\Controllers\Admin\DiagnosticAssessmentController::class, 'export'])->name('assessments.export');

    // Diagnostic Items Management
    Route::resource('items', \App\Http\Controllers\Admin\DiagnosticItemController::class);
    Route::get('items/{item}/test', [\App\Http\Controllers\Admin\DiagnosticItemController::class, 'test'])->name('items.test');
    Route::post('items/{item}/review', [\App\Http\Controllers\Admin\DiagnosticItemController::class, 'review'])->name('items.review');
    Route::post('items/bulk-action', [\App\Http\Controllers\Admin\DiagnosticItemController::class, 'bulkAction'])->name('items.bulk-action');
    
    // Diagnostic Domain Management (Domains -> Topics -> Subtopics)
    Route::prefix('domains')->name('domains.')->group(function () {
        Route::get('/', [DiagnosticDomainController::class, 'index'])->name('index');
        
        // Domain operations
        Route::post('/', [DiagnosticDomainController::class, 'storeDomain'])->name('store');
        Route::put('/{domain}', [DiagnosticDomainController::class, 'updateDomain'])->name('update');
        Route::delete('/{domain}', [DiagnosticDomainController::class, 'destroyDomain'])->name('destroy');
        
        // Topic operations
        Route::post('/topics', [DiagnosticDomainController::class, 'storeTopic'])->name('topics.store');
        Route::put('/topics/{topic}', [DiagnosticDomainController::class, 'updateTopic'])->name('topics.update');
        Route::delete('/topics/{topic}', [DiagnosticDomainController::class, 'destroyTopic'])->name('topics.destroy');
        
        // Subtopic operations
        Route::post('/subtopics', [DiagnosticDomainController::class, 'storeSubtopic'])->name('subtopics.store');
        Route::put('/subtopics/{subtopic}', [DiagnosticDomainController::class, 'updateSubtopic'])->name('subtopics.update');
        Route::delete('/subtopics/{subtopic}', [DiagnosticDomainController::class, 'destroySubtopic'])->name('subtopics.destroy');
        
        // Reordering
        Route::post('/reorder', [DiagnosticDomainController::class, 'reorder'])->name('reorder');
    });
});

// Master Data Management
Route::prefix('master')->name('master.')->group(function () {
    Route::resource('question-types', \App\Http\Controllers\Admin\Master\QuestionTypeController::class);
    
    // Bloom Levels Management
    Route::get('blooms', [\App\Http\Controllers\Admin\Master\BloomController::class, 'index'])->name('blooms.index');
    Route::put('blooms/{bloom}', [\App\Http\Controllers\Admin\Master\BloomController::class, 'update'])->name('blooms.update');
    Route::post('blooms/{bloom}/toggle-status', [\App\Http\Controllers\Admin\Master\BloomController::class, 'toggleStatus'])->name('blooms.toggle-status');
});

// System Management
Route::prefix('system')->name('system.')->group(function () {
    Route::get('logs', [LogController::class, 'index'])->name('logs.index');
});

// TODO: Add these controllers when ready
// Route::resource('questions', QuestionController::class);
// Route::resource('assessments', AssessmentController::class)->only(['index', 'show']);
// Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
// Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');