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

        // Build CSP directives based on environment
        $isLocal = app()->environment('local');
        
        $scriptSrc = [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'",
            "https://www.google-analytics.com",
            "https://www.googletagmanager.com", 
            "https://app.posthog.com",
            "https://us.i.posthog.com",
            "https://us-assets.i.posthog.com"
        ];
        
        $styleSrc = [
            "'self'",
            "'unsafe-inline'",
            "https://fonts.googleapis.com",
            "https://fonts.bunny.net"
        ];
        
        $fontSrc = [
            "'self'",
            "https://fonts.gstatic.com",
            "https://fonts.bunny.net"
        ];
        
        // Add local development URLs
        if ($isLocal) {
            $scriptSrc[] = "http://127.0.0.1:5173";
            $scriptSrc[] = "http://localhost:5173";
            $scriptSrc[] = "ws://127.0.0.1:5173";
            $scriptSrc[] = "ws://localhost:5173";
        }

        $cspDirectives = [
            "default-src 'self'",
            "script-src " . implode(' ', $scriptSrc),
            "style-src " . implode(' ', $styleSrc),
            "font-src " . implode(' ', $fontSrc),
            "img-src 'self' data: https: blob:",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "frame-ancestors 'none'",
        ];

        $connectSrc = [
            "'self'",
            "https://www.google-analytics.com",
            "https://analytics.google.com",
            "https://stats.g.doubleclick.net",
            "https://app.posthog.com",
            "https://us.i.posthog.com",
            "https://us-assets.i.posthog.com"
        ];
        
        // Add local development URLs to connect-src
        if ($isLocal) {
            $connectSrc[] = "http://127.0.0.1:5173";
            $connectSrc[] = "http://localhost:5173";
            $connectSrc[] = "ws://127.0.0.1:5173";
            $connectSrc[] = "ws://localhost:5173";
            $connectSrc[] = "ws://127.0.0.1:8080";
            $connectSrc[] = "ws://localhost:8080";
        }

        // Add WebSocket support for broadcasting
        if (config('broadcasting.default') === 'reverb' && env('VITE_ENABLE_WEBSOCKETS') === 'true') {
            $host = parse_url(config('app.url'), PHP_URL_HOST);
            $port = env('REVERB_PORT', 6001);
            $connectSrc[] = "wss://{$host}:{$port}";
        }
        
        // Fallback: Always add WebSocket for saazacademy.com domain
        $host = parse_url(config('app.url'), PHP_URL_HOST);
        if (str_contains($host, 'saazacademy.com')) {
            $connectSrc[] = "wss://saazacademy.com:6001";
        }

        $cspDirectives[] = "connect-src " . implode(' ', $connectSrc);

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));

        return $response;
    }
}
