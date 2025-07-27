<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure storage directories exist for testing
        if (!file_exists(storage_path('framework/sessions'))) {
            mkdir(storage_path('framework/sessions'), 0755, true);
        }
        
        if (!file_exists(storage_path('framework/cache'))) {
            mkdir(storage_path('framework/cache'), 0755, true);
        }
        
        // Disable CSRF for testing
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    }
}
