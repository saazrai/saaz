<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    // Social authentication routes
    Route::prefix('auth/social')->name('auth.social.')->group(function () {
        Route::get('{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('redirect');
        Route::get('{provider}/callback', [SocialAuthController::class, 'callback'])->name('callback');
    });

    // Email verification for registration (pre-registration verification)
    Route::post('/email/send-verification', [EmailVerificationController::class, 'sendVerificationCodeToEmail'])
        ->name('email.send.verification')
        ->middleware('throttle:3,1'); // 3 requests per minute

    Route::post('/email/verify-code', [EmailVerificationController::class, 'verifyCode'])
        ->name('email.verify.code')
        ->middleware('throttle:5,1'); // 5 attempts per minute

    Route::post('/email/verification-resend', [EmailVerificationController::class, 'resend'])
        ->name('email.verification.resend')
        ->middleware('throttle:2,1'); // 2 resends per minute
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('verify-email/change', [EmailVerificationController::class, 'changeEmail'])
        ->middleware('throttle:3,1')
        ->name('verification.email.change');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
