<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Content Security Policy - Allow Vite dev server in development --}}
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.bunny.net{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:*' : '' }}; style-src 'self' 'unsafe-inline' https://fonts.bunny.net{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:*' : '' }}; font-src 'self' https://fonts.bunny.net; img-src 'self' data: https:; connect-src 'self'{{ config('app.debug') ? ' http://localhost:* http://127.0.0.1:* ws://localhost:* ws://127.0.0.1:*' : '' }};">

        {{-- Inline script to detect theme preference and apply it immediately --}}
        <script>
            (function() {
                // First check localStorage for user preference
                const savedTheme = localStorage.getItem('theme');
                let theme = savedTheme || 'dark'; // Default to dark
                
                // If no saved preference, check system preference
                if (!savedTheme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }
                
                // Apply theme class for Tailwind
                document.documentElement.classList.remove('light', 'dark');
                document.documentElement.classList.add(theme);
                
                // Set data-theme attribute for CSS variables
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>


        <title inertia>{{ config('app.name', 'Laravel') }}</title>

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
