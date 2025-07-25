<?php

use App\Http\Controllers\Api\ProfilePreferencesController;
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

Route::middleware(['web', 'auth'])->group(function () {
    // User preferences endpoints
    Route::get('/profile/ui-preferences', [ProfilePreferencesController::class, 'show']);
    Route::patch('/profile/ui-preferences', [ProfilePreferencesController::class, 'update']);
});
