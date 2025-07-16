<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     */
    public function redirect(string $provider): RedirectResponse
    {
        if (! in_array($provider, ['google', 'linkedin', 'github'])) {
            abort(404);
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to redirect to '.ucfirst($provider).'. Please try again.');
        }
    }

    /**
     * Obtain the user information from the provider.
     */
    public function callback(string $provider): RedirectResponse
    {
        if (! in_array($provider, ['google', 'linkedin', 'github'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Authentication failed. Please try again.');
        }

        // Check if user exists with this email using encrypted email lookup
        $user = User::findByEmail($socialUser->getEmail());

        if ($user) {
            // Update social provider info if not already set
            if ($provider === 'google' && !$user->google_id) {
                $user->update([
                    'google_id' => $socialUser->getId(),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }
        } else {
            // Create new user
            $userData = [
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(32)),
                'avatar' => $socialUser->getAvatar(),
            ];

            // Add provider-specific ID
            if ($provider === 'google') {
                $userData['google_id'] = $socialUser->getId();
            }

            $user = User::create($userData);

            // For new social auth users, we'll handle consent through the dashboard
            // The CheckCookieConsent middleware will handle consent requirements
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
