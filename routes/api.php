<?php

use App\Http\Controllers\Api\ProfilePreferencesController;
use App\Http\Controllers\Api\SampleQuizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Sample Quiz Analytics - Public endpoints (no auth required)
Route::prefix('sample-quiz')->name('api.sample-quiz.')->group(function () {
    // Get sample quiz questions from database
    Route::get('/questions', [SampleQuizController::class, 'getQuestions'])->name('questions');
    
    // RESTful assessment management
    Route::post('/assessments', [SampleQuizController::class, 'store'])->name('store');
    
    // Individual response tracking (new normalized approach)
    Route::post('/response', [SampleQuizController::class, 'storeResponse'])->name('store-response');
    Route::post('/complete-assessment', [SampleQuizController::class, 'completeAssessment'])->name('complete-assessment');
    Route::post('/progress', [SampleQuizController::class, 'getProgress'])->name('get-progress');
    
    // Legacy endpoints (for backward compatibility)
    Route::post('/session-id', [SampleQuizController::class, 'generateSessionId'])->name('generate-session');
    Route::post('/complete', [SampleQuizController::class, 'storeCompletion'])->name('complete');
    
    // Analytics endpoints
    Route::get('/analytics', [SampleQuizController::class, 'getAnalytics'])->name('analytics');
    Route::get('/question-analytics', [SampleQuizController::class, 'getQuestionAnalytics'])->name('question-analytics');
    Route::get('/domain-analytics', [SampleQuizController::class, 'getDomainAnalytics'])->name('domain-analytics');
    Route::get('/difficulty-analytics', [SampleQuizController::class, 'getDifficultyAnalytics'])->name('difficulty-analytics');
    Route::get('/bloom-analytics', [SampleQuizController::class, 'getBloomAnalytics'])->name('bloom-analytics');
});

Route::middleware(['web', 'auth'])->group(function () {
    // User preferences endpoints
    Route::get('/profile/ui-preferences', [ProfilePreferencesController::class, 'show']);
    Route::patch('/profile/ui-preferences', [ProfilePreferencesController::class, 'update']);
});
