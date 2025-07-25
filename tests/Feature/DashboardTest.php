<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    \App\Models\PrivacyConsent::create([
        'user_id' => $user->id,
        'regulation' => 'GDPR',
        'consent_version' => '1.0',
        'is_consent_given' => true,
        'consent_given_at' => now(),
        'consent_preferences' => [
            'cookie_consent_given' => true,
            'strictly_necessary' => true,
            'functional' => true,
            'analytics' => true,
            'marketing' => true,
        ],
        'ip_address' => '127.0.0.1',
        'user_agent' => 'TestAgent',
    ]);
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
