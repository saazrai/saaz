<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('password can be updated', function () {
    $user = User::factory()->create();
    
    // Create privacy consent for the user
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

    $response = $this->actingAs($user)->put('/settings/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();
    
    // Create privacy consent for the user
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

    $response = $this->actingAs($user)->put('/settings/password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
        ->assertSessionHasErrors('current_password')
        ->assertRedirect('/');
});