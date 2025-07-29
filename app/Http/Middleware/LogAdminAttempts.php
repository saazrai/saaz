<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class LogAdminAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only process admin route attempts
        if ($request->is('admin') || $request->is('admin/*')) {
            $ip = $request->ip();
            
            // Only apply rate limiting to unauthenticated users
            if (!auth()->check()) {
                $rateLimitKey = 'admin-attempts:' . $ip;
                
                // Rate limiting: 50 attempts per 15 minutes per IP (more lenient for development)
                if (RateLimiter::tooManyAttempts($rateLimitKey, 50)) {
                    // Log rate limit exceeded
                    Log::channel('security')->error('Admin route rate limit exceeded', [
                        'ip' => $ip,
                        'user_agent' => $request->userAgent(),
                        'url' => $request->fullUrl(),
                        'attempts' => RateLimiter::attempts($rateLimitKey),
                        'timestamp' => now()->toDateTimeString(),
                    ]);
                    
                    // Return 429 Too Many Requests (standard rate limiting response)
                    abort(429, 'Too Many Requests');
                }
                
                // Increment rate limiter (15 minutes window)
                RateLimiter::hit($rateLimitKey, 900); // 15 minutes = 900 seconds
                
                // Log the attempt
                Log::channel('security')->warning('Unauthenticated admin route attempt', [
                    'ip' => $ip,
                    'user_agent' => $request->userAgent(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'referer' => $request->header('referer'),
                    'attempts_count' => RateLimiter::attempts($rateLimitKey),
                    'timestamp' => now()->toDateTimeString(),
                ]);
                
                // Log warning if approaching rate limit
                $attempts = RateLimiter::attempts($rateLimitKey);
                if ($attempts >= 40) { // Warn at 80% of limit
                    Log::channel('security')->warning('Admin route attempts approaching limit', [
                        'ip' => $ip,
                        'attempts' => $attempts,
                        'limit' => 50,
                        'timestamp' => now()->toDateTimeString(),
                    ]);
                }
            }
        }

        return $next($request);
    }
}
