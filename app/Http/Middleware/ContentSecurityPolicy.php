<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Build CSP based on environment
        $cspDirectives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google-analytics.com https://www.googletagmanager.com https://app.posthog.com https://us.i.posthog.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: https: blob:",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "frame-ancestors 'none'",
        ];
        
        // Add WebSocket connections for production
        $connectSrc = [
            "'self'",
            "https://www.google-analytics.com",
            "https://analytics.google.com", 
            "https://stats.g.doubleclick.net",
            "https://app.posthog.com",
            "https://us.i.posthog.com",
            "https://us-assets.i.posthog.com"
        ];
        
        // Add WebSocket URLs if WebSockets are enabled
        if (config('broadcasting.default') === 'reverb' && env('VITE_ENABLE_WEBSOCKETS') === 'true') {
            $reverbHost = env('REVERB_HOST', 'localhost');
            $reverbPort = env('REVERB_PORT', '8080');
            $reverbScheme = env('REVERB_SCHEME', 'https');
            
            // Add WebSocket URLs
            $connectSrc[] = "{$reverbScheme}://{$reverbHost}";
            $connectSrc[] = "{$reverbScheme}://{$reverbHost}:{$reverbPort}";
            
            // Add WebSocket protocols
            if ($reverbScheme === 'https') {
                $connectSrc[] = "wss://{$reverbHost}";
                $connectSrc[] = "wss://{$reverbHost}:{$reverbPort}";
            } else {
                $connectSrc[] = "ws://{$reverbHost}";
                $connectSrc[] = "ws://{$reverbHost}:{$reverbPort}";
            }
        }
        
        $cspDirectives[] = "connect-src " . implode(' ', $connectSrc);
        
        // Set CSP header
        $csp = implode('; ', $cspDirectives);
        $response->headers->set('Content-Security-Policy', $csp);
        
        return $response;
    }
}
