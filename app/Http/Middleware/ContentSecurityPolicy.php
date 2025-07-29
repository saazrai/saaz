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

        $connectSrc = [
            "'self'",
            "https://www.google-analytics.com",
            "https://analytics.google.com",
            "https://stats.g.doubleclick.net",
            "https://app.posthog.com",
            "https://us.i.posthog.com",
            "https://us-assets.i.posthog.com"
        ];

        if (config('broadcasting.default') === 'reverb' && env('VITE_ENABLE_WEBSOCKETS') === 'true') {
            $host = parse_url(config('app.url'), PHP_URL_HOST);
            $port = env('REVERB_PORT', 6001);
            $connectSrc[] = "wss://{$host}:{$port}";
        }

        $cspDirectives[] = "connect-src " . implode(' ', $connectSrc);

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));

        return $response;
    }
}
