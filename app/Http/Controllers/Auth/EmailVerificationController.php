<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class EmailVerificationController extends Controller
{
    /**
     * Send verification code to email (Step 1 of registration)
     */
    public function sendVerificationCodeToEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'consent' => 'required|accepted',
        ]);

        $email = $request->email;

        // Check rate limiting
        $key = "email_verification_send_{$email}";
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ["Too many verification attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        // Generate 4-digit code
        $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Store code in cache for 10 minutes
        $cacheKey = "email_verification_code_{$email}";
        Cache::put($cacheKey, $code, Carbon::now()->addMinutes(10));

        // Store email and consent temporarily
        $tempDataKey = "temp_registration_data_{$email}";
        Cache::put($tempDataKey, [
            'email' => $email,
            'consent' => true,
            'created_at' => now(),
        ], Carbon::now()->addMinutes(30)); // 30 minutes for the whole process

        // Send email
        $this->sendVerificationCodeEmail($email, $code);

        // Increment rate limiter
        RateLimiter::hit($key, 60); // 1 minute timeout

        return back()->with('success', 'Verification code sent!');
    }

    /**
     * Verify the 4-digit email verification code (Step 2 of registration)
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|string|size:4',
        ]);

        $email = $request->email;
        $code = $request->verification_code;
        $cacheKey = "email_verification_code_{$email}";

        // Check if code exists and matches
        $storedCode = Cache::get($cacheKey);

        if (! $storedCode || $storedCode !== $code) {
            throw ValidationException::withMessages([
                'verification_code' => ['The verification code is invalid or has expired.'],
            ]);
        }

        // Mark email as verified in temporary storage
        $tempDataKey = "temp_registration_data_{$email}";
        $tempData = Cache::get($tempDataKey);

        if (! $tempData) {
            throw ValidationException::withMessages([
                'email' => ['Email verification session has expired. Please start over.'],
            ]);
        }

        $tempData['email_verified'] = true;
        Cache::put($tempDataKey, $tempData, Carbon::now()->addMinutes(30));

        // Clear the verification code
        Cache::forget($cacheKey);

        return back()->with('success', 'Email verified successfully!');
    }

    /**
     * Resend verification code
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Check rate limiting
        $key = "email_verification_send_{$email}";
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ["Too many resend attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        // Check if temporary data exists
        $tempDataKey = "temp_registration_data_{$email}";
        if (! Cache::get($tempDataKey)) {
            throw ValidationException::withMessages([
                'email' => ['Email verification session has expired. Please start over.'],
            ]);
        }

        // Generate new 4-digit code
        $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Store code in cache for 10 minutes
        $cacheKey = "email_verification_code_{$email}";
        Cache::put($cacheKey, $code, Carbon::now()->addMinutes(10));

        // Send email
        $this->sendVerificationCodeEmail($email, $code);

        // Increment rate limiter
        RateLimiter::hit($key, 60); // 1 minute timeout

        return back()->with('success', 'Verification code sent!');
    }

    /**
     * Get temporary registration data for final step
     */
    public function getTempData($email)
    {
        $tempDataKey = "temp_registration_data_{$email}";

        return Cache::get($tempDataKey);
    }

    /**
     * Clear temporary registration data
     */
    public function clearTempData($email)
    {
        $tempDataKey = "temp_registration_data_{$email}";
        Cache::forget($tempDataKey);
    }

    /**
     * Change email address during verification
     */
    public function changeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required|string',
        ]);

        $user = $request->user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password is incorrect.'],
            ]);
        }

        // Update user's email
        $user->email = $request->email;
        $user->email_verified_at = null; // Reset verification status
        $user->save();

        // Send new verification email
        $user->sendEmailVerificationNotification();

        return back()->with('status', 'email-changed');
    }

    /**
     * Send verification code email to email address
     */
    private function sendVerificationCodeEmail($email, $code)
    {
        try {
            Mail::send('emails.verification-code', [
                'user' => (object) ['email' => $email, 'name' => 'Future SecureStart™ User'],
                'code' => $code,
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Verify Your Email - SecureStart™');
            });
        } catch (\Exception $e) {
            // Log error but don't throw - user can request resend
            \Log::error('Failed to send verification email: '.$e->getMessage());
        }
    }
}