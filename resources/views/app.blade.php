<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Content Security Policy - Allow Vite dev server in development --}}
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.bunny.net https://www.googletagmanager.com https://www.google-analytics.com https://app.posthog.com{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:*' : '' }}; style-src 'self' 'unsafe-inline' https://fonts.bunny.net{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:*' : '' }}; font-src 'self' https://fonts.bunny.net; img-src 'self' data: https: https://www.google-analytics.com; connect-src 'self' https://www.google-analytics.com https://analytics.google.com https://stats.g.doubleclick.net https://app.posthog.com{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:* ws://localhost:* ws://127.0.0.1:*' : '' }};">

        {{-- Force dark theme by default with CSS --}}
        <style>
            html { 
                background-color: #0f172a !important; 
                color: #f8fafc !important; 
            }
            html.dark { 
                background-color: #0f172a !important; 
                color: #f8fafc !important; 
            }
        </style>

        {{-- Inline script to detect theme preference and apply it immediately --}}
        <script>
            (function() {
                // Force dark theme as default - be more aggressive
                const savedTheme = localStorage.getItem('theme');
                let theme = savedTheme || 'dark'; // Default to dark always
                
                // Store dark as default if nothing was saved
                if (!savedTheme) {
                    localStorage.setItem('theme', 'dark');
                }
                
                // Force apply theme classes immediately
                document.documentElement.classList.remove('light', 'dark');
                document.documentElement.classList.add(theme);
                
                // Set data-theme attribute for CSS variables
                document.documentElement.setAttribute('data-theme', theme);
                
                // Also set a CSS custom property for immediate styling
                document.documentElement.style.setProperty('--theme-mode', theme);
            })();
        </script>


        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        {{-- Google Analytics 4 - Saaz Academy --}}
        @if(\App\Services\GoogleAnalyticsService::isEnabled())
        {!! \App\Services\GoogleAnalyticsService::getTrackingScript() !!}
        @endif

        {{-- PostHog Analytics - Saaz Academy --}}
        @if(\App\Services\PostHogService::isEnabled())
        {!! \App\Services\PostHogService::getJavaScriptInit() !!}
        @endif

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @routes
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
