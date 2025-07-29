<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login');
        }

        // Check if user has access to admin panel
        if (!auth()->user()->hasPermissionTo('access admin panel')) {
            $userId = auth()->id();
            $ip = $request->ip();
            $rateLimitKey = 'unauthorized-admin:' . $userId . ':' . $ip;
            
            // Rate limiting for unauthorized admin attempts: 5 attempts per 10 minutes per user+IP
            if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
                Log::channel('security')->error('Unauthorized admin access rate limit exceeded', [
                    'user_id' => $userId,
                    'email' => auth()->user()->email,
                    'ip' => $ip,
                    'attempts' => RateLimiter::attempts($rateLimitKey),
                    'timestamp' => now()->toDateTimeString(),
                ]);
                
                abort(429, 'Too Many Requests');
            }
            
            // Increment rate limiter (10 minutes window)
            RateLimiter::hit($rateLimitKey, 600); // 10 minutes = 600 seconds
            
            // Log unauthorized admin access attempt
            Log::channel('security')->warning('Unauthorized admin access attempt', [
                'user_id' => $userId,
                'email' => auth()->user()->email,
                'ip' => $ip,
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'referer' => $request->header('referer'),
                'attempts_count' => RateLimiter::attempts($rateLimitKey),
                'timestamp' => now()->toDateTimeString(),
            ]);
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Not found.'], 404);
            }
            
            abort(404);
        }

        // Check if user account is active
        if (!auth()->user()->is_active) {
            auth()->logout();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your account has been deactivated.'], 403);
            }
            
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}