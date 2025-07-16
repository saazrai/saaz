<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'consent' => 'required|accepted',
        ]);

        // Check if email was verified through the 3-step process
        $tempDataKey = "temp_registration_data_{$request->email}";
        $tempData = Cache::get($tempDataKey);

        if (!$tempData || !isset($tempData['email_verified']) || !$tempData['email_verified']) {
            throw ValidationException::withMessages([
                'email' => ['Email verification is required. Please complete the verification process.'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), // Mark as verified since they completed the verification process
        ]);

        event(new Registered($user));

        // Clear the temporary registration data
        Cache::forget($tempDataKey);

        Auth::login($user);

        return to_route('dashboard');
    }
}
