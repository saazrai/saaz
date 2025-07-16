<?php

namespace App\Providers;

use App\Mail\BrevoTransport;
use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;

class BrevoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->afterResolving(MailManager::class, function (MailManager $mailManager) {
            $mailManager->extend('brevo', function (array $config) {
                return new BrevoTransport($config['api_key']);
            });
        });
    }

    public function boot(): void
    {
        //
    }
}