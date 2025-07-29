<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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

// TODO: Add these controllers when ready
// Route::resource('questions', QuestionController::class);
// Route::resource('assessments', AssessmentController::class)->only(['index', 'show']);
// Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
// Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');