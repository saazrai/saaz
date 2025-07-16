<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnforceConsentForAnalyticsAndMarketing
{
    public function handle(Request $request, Closure $next, $type)
    {
        $user = Auth::user();
        if (! $user) {
            return $next($request);
        }
        $consent = $user->privacyConsents()
            ->where('regulation', 'GDPR')
            ->latest('consent_given_at')
            ->first();
        if ($type === 'analytics' && (! $consent || empty($consent->consent_preferences['analytics']))) {
            return redirect()->route('privacy.settings')->with('warning', 'You must consent to analytics to use this feature.');
        }
        if ($type === 'marketing' && (! $consent || empty($consent->consent_preferences['marketing']))) {
            return redirect()->route('privacy.settings')->with('warning', 'You must consent to marketing to use this feature.');
        }
        $requiredVersion = config('privacy.current_version', '1.0');
        if (! $consent || $consent->version !== $requiredVersion) {
            return redirect()->route('privacy.consent');
        }

        return $next($request);
    }
}