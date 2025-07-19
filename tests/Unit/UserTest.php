<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can create user with required fields', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    expect($user)
        ->name->toBe('John Doe')
        ->email->toBe('john@example.com')
        ->password->not->toBeNull()
        ->email_verified_at->not->toBeNull();
});

test('can create user with google oauth', function () {
    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'google_id' => '123456789',
        'avatar' => 'https://example.com/avatar.jpg',
        'password' => null,
    ]);

    expect($user)
        ->name->toBe('Jane Doe')
        ->email->toBe('jane@example.com')
        ->google_id->toBe('123456789')
        ->avatar->toBe('https://example.com/avatar.jpg')
        ->password->toBeNull();
});

test('can find user by email', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $foundUser = User::findByEmail('test@example.com');

    expect($foundUser)
        ->not->toBeNull()
        ->id->toBe($user->id)
        ->email->toBe('test@example.com');
});

test('returns null when user not found by email', function () {
    $foundUser = User::findByEmail('nonexistent@example.com');

    expect($foundUser)->toBeNull();
});

test('user needs consent when no privacy consent exists', function () {
    $user = User::factory()->create();

    expect($user->needsConsent())->toBeTrue();
});

test('user consent status returns default when no consent', function () {
    $user = User::factory()->create();

    $status = $user->getConsentStatus();

    expect($status)
        ->consent_given->toBeFalse()
        ->consent_date->toBeNull()
        ->categories->strictly_necessary->toBeTrue()
        ->categories->functional->toBeFalse()
        ->categories->analytics->toBeFalse()
        ->categories->marketing->toBeFalse();
});

test('user password is hidden in serialization', function () {
    $user = User::factory()->create();

    $array = $user->toArray();

    expect($array)->not->toHaveKey('password');
    expect($array)->not->toHaveKey('remember_token');
});

test('user fillable fields are correct', function () {
    $user = new User();

    expect($user->getFillable())->toBe([
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'email_verified_at',
        'ui_preferences',
    ]);
});

test('user audit excludes sensitive fields', function () {
    $user = new User();

    expect($user->getAuditExclude())->toContain('password');
    expect($user->getAuditExclude())->toContain('remember_token');
    expect($user->getAuditExclude())->toContain('email_verified_at');
});