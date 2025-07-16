<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCookieConsent
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip for API routes, auth routes, and consent routes
        if ($request->is('api/*') ||
            $request->is('login*') ||
            $request->is('register*') ||
            $request->is('privacy/*') ||
            $request->is('cookies') ||
            $request->is('privacy-policy') ||
            $request->is('terms') ||
            $request->expectsJson()) {
            return $next($request);
        }

        // Only check for authenticated users
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user needs to provide consent
            if ($user->needsConsent()) {
                // Store intended URL for redirect after consent
                session(['url.intended' => $request->url()]);

                return redirect()->route('privacy.consent')
                    ->with('message', 'Please review and accept our updated privacy policy to continue.');
            }
        }

        return $next($request);
    }
}
