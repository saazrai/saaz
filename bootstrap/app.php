<?php

use App\Http\Middleware\CheckCookieConsent;
use App\Http\Middleware\EnforceConsentForAnalyticsAndMarketing;
use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state', 'cookie_consent']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            CheckCookieConsent::class,
        ]);

        $middleware->alias([
            'cookie.consent' => CheckCookieConsent::class,
            'consent.analytics' => EnforceConsentForAnalyticsAndMarketing::class.':analytics',
            'consent.marketing' => EnforceConsentForAnalyticsAndMarketing::class.':marketing',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
