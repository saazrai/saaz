<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register AdaptiveDiagnosticService
        $this->app->singleton(\App\Services\AdaptiveDiagnosticService::class, function ($app) {
            return new \App\Services\AdaptiveDiagnosticService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
