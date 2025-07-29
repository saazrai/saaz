<?php

use App\Models\PrivacySetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('privacy setting can be created with fillable fields', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'analytics_consent' => false,
        'third_party_consent' => true,
        'consent_given_at' => now(),
        'consent_version' => '1.0',
        'consent_history' => [
            [
                'version' => '1.0',
                'given_at' => now()->toISOString(),
                'marketing' => true,
                'analytics' => false,
            ]
        ],
    ]);

    expect($privacySetting)
        ->user_id->toBe($user->id)
        ->marketing_consent->toBeTrue()
        ->analytics_consent->toBeFalse()
        ->third_party_consent->toBeTrue()
        ->consent_given_at->toBeInstanceOf(Carbon\Carbon::class)
        ->consent_version->toBe('1.0')
        ->consent_history->toBeArray();
});

test('privacy setting fillable fields are correct', function () {
    $privacySetting = new PrivacySetting;

    expect($privacySetting->getFillable())->toBe([
        'user_id',
        'marketing_consent',
        'analytics_consent',
        'third_party_consent',
        'consent_given_at',
        'consent_version',
        'consent_history',
    ]);
});

test('privacy setting has correct casts', function () {
    $privacySetting = new PrivacySetting;
    $casts = $privacySetting->getCasts();

    expect($casts)
        ->marketing_consent->toBe('boolean')
        ->analytics_consent->toBe('boolean')
        ->third_party_consent->toBe('boolean')
        ->consent_history->toBe('array')
        ->consent_given_at->toBe('datetime');
});

test('privacy setting extends base model', function () {
    $privacySetting = new PrivacySetting;

    expect($privacySetting)->toBeInstanceOf(\App\Models\BaseModel::class);
});

test('privacy setting implements auditable', function () {
    $privacySetting = new PrivacySetting;

    expect($privacySetting)->toBeInstanceOf(\OwenIt\Auditing\Contracts\Auditable::class);
});

test('privacy setting belongs to user', function () {
    $user = User::factory()->create();
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_given_at' => now(),
    ]);

    expect($privacySetting->user)->toBeInstanceOf(User::class);
    expect($privacySetting->user->id)->toBe($user->id);
});

test('privacy setting consent history can track changes', function () {
    $user = User::factory()->create();
    
    $initialConsent = [
        'version' => '1.0',
        'given_at' => now()->subDays(30)->toISOString(),
        'marketing' => false,
        'analytics' => false,
        'third_party' => false,
    ];

    $updatedConsent = [
        'version' => '1.1',
        'given_at' => now()->toISOString(),
        'marketing' => true,
        'analytics' => true,
        'third_party' => false,
    ];

    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'analytics_consent' => true,
        'third_party_consent' => false,
        'consent_given_at' => now(),
        'consent_version' => '1.1',
        'consent_history' => [$initialConsent, $updatedConsent],
    ]);

    expect($privacySetting->consent_history)->toHaveCount(2);
    expect($privacySetting->consent_history[0]['version'])->toBe('1.0');
    expect($privacySetting->consent_history[1]['version'])->toBe('1.1');
    expect($privacySetting->consent_history[1]['marketing'])->toBeTrue();
});

test('privacy setting boolean casts work correctly', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => '1', // String that should cast to boolean
        'analytics_consent' => '0', // String that should cast to boolean
        'third_party_consent' => 1, // Integer that should cast to boolean
        'consent_given_at' => now(),
    ]);

    expect($privacySetting->marketing_consent)->toBeTrue();
    expect($privacySetting->analytics_consent)->toBeFalse();
    expect($privacySetting->third_party_consent)->toBeTrue();
});

test('privacy setting datetime cast works correctly', function () {
    $user = User::factory()->create();
    $consentDate = '2024-01-15 10:30:00';
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_given_at' => $consentDate,
    ]);

    expect($privacySetting->consent_given_at)->toBeInstanceOf(Carbon\Carbon::class);
    expect($privacySetting->consent_given_at->format('Y-m-d H:i:s'))->toBe($consentDate);
});

test('privacy setting array cast works correctly', function () {
    $user = User::factory()->create();
    $history = [
        ['version' => '1.0', 'marketing' => true],
        ['version' => '2.0', 'marketing' => false],
    ];
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_history' => $history,
        'consent_given_at' => now(),
    ]);

    expect($privacySetting->consent_history)->toBeArray();
    expect($privacySetting->consent_history)->toBe($history);
});

test('privacy setting can be updated with safe update', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => false,
        'analytics_consent' => false,
        'consent_given_at' => now(),
    ]);

    $result = $privacySetting->safeUpdate([
        'marketing_consent' => true,
        'analytics_consent' => true,
        'consent_version' => '2.0',
        'id' => 999, // Should be ignored (not fillable)
        'created_at' => now()->addDay(), // Should be ignored (not fillable)
    ]);

    expect($result)->toBeTrue();
    expect($privacySetting->fresh())
        ->marketing_consent->toBeTrue()
        ->analytics_consent->toBeTrue()
        ->consent_version->toBe('2.0')
        ->id->not->toBe(999); // Should remain original
});

test('privacy setting uses auditing trait', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_given_at' => now(),
    ]);

    expect(method_exists($privacySetting, 'audits'))->toBeTrue();
    expect(method_exists($privacySetting, 'generateTags'))->toBeTrue();
});

test('privacy setting can handle null consent history', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_given_at' => now(),
        'consent_history' => null,
    ]);

    expect($privacySetting->consent_history)->toBeNull();
});

test('privacy setting relationship with user works both ways', function () {
    $user = User::factory()->create();
    
    $privacySetting = PrivacySetting::create([
        'user_id' => $user->id,
        'marketing_consent' => true,
        'consent_given_at' => now(),
    ]);

    // Test privacy setting -> user relationship
    expect($privacySetting->user->id)->toBe($user->id);
    
    // Test user -> privacy setting relationship
    expect($user->privacySetting->id)->toBe($privacySetting->id);
});