<?php

use App\Models\DiagnosticProfile;
use App\Models\User;
use App\Models\DiagnosticDomain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

uses(RefreshDatabase::class);

test('can create diagnostic profile with required fields', function () {
    $user = User::factory()->create();
    $domain = DiagnosticDomain::factory()->create();
    
    $profile = DiagnosticProfile::factory()->create([
        'user_id' => $user->id,
        'domain_id' => $domain->id,
        'proficiency' => 0.75,
        'confidence' => 0.85,
        'last_bloom_level' => 3,
    ]);

    expect($profile)
        ->user_id->toBe($user->id)
        ->domain_id->toBe($domain->id)
        ->proficiency->toBe(0.75)
        ->confidence->toBe(0.85)
        ->last_bloom_level->toBe(3);
});

test('diagnostic profile belongs to user', function () {
    $user = User::factory()->create();
    $profile = DiagnosticProfile::factory()->create(['user_id' => $user->id]);

    expect($profile->user)
        ->not->toBeNull()
        ->id->toBe($user->id);
});

test('diagnostic profile belongs to domain', function () {
    $domain = DiagnosticDomain::factory()->create();
    $profile = DiagnosticProfile::factory()->create(['domain_id' => $domain->id]);

    expect($profile->domain)
        ->not->toBeNull()
        ->id->toBe($domain->id);
});

test('calculates days since last assessment', function () {
    $profile = DiagnosticProfile::factory()->create([
        'last_assessed_at' => Carbon::now()->subDays(5),
    ]);

    expect($profile->days_since_last_assessment)->toBe(5);
});

test('returns null for days since assessment when never assessed', function () {
    $profile = DiagnosticProfile::factory()->create([
        'last_assessed_at' => null,
    ]);

    expect($profile->days_since_last_assessment)->toBeNull();
});

test('casts arrays correctly', function () {
    $profile = DiagnosticProfile::factory()->create([
        'bloom_distribution' => [1 => 2, 2 => 3, 3 => 5],
        'strengths' => ['Risk Management', 'Access Control'],
        'weaknesses' => ['Cryptography'],
    ]);

    expect($profile->bloom_distribution)->toBeArray();
    expect($profile->strengths)->toBeArray();
    expect($profile->weaknesses)->toBeArray();
    expect($profile->bloom_distribution[3])->toBe(5);
    expect($profile->strengths)->toContain('Risk Management');
    expect($profile->weaknesses)->toContain('Cryptography');
});

test('casts decimal fields correctly', function () {
    $profile = DiagnosticProfile::factory()->create([
        'proficiency' => 0.7567,
        'confidence' => 0.8234,
        'average_response_time' => 45.678,
    ]);

    // Decimals are cast to 2 places
    expect($profile->proficiency)->toBe(0.76);
    expect($profile->confidence)->toBe(0.82);
    expect($profile->average_response_time)->toBe(45.68);
});

test('casts datetime fields correctly', function () {
    $now = Carbon::now();
    $profile = DiagnosticProfile::factory()->create([
        'first_assessed_at' => $now,
        'last_assessed_at' => $now,
    ]);

    expect($profile->first_assessed_at)->toBeInstanceOf(Carbon::class);
    expect($profile->last_assessed_at)->toBeInstanceOf(Carbon::class);
});

test('diagnostic profile audit includes important fields', function () {
    $profile = new DiagnosticProfile();

    $auditInclude = $profile->getAuditInclude();

    expect($auditInclude)->toContain('proficiency');
    expect($auditInclude)->toContain('confidence');
    expect($auditInclude)->toContain('last_bloom_level');
    expect($auditInclude)->toContain('questions_answered');
    expect($auditInclude)->toContain('questions_correct');
    expect($auditInclude)->toContain('last_assessed_at');
});

test('tracks consecutive streaks correctly', function () {
    $profile = DiagnosticProfile::factory()->create([
        'consecutive_correct' => 5,
        'consecutive_incorrect' => 0,
    ]);

    expect($profile->consecutive_correct)->toBe(5);
    expect($profile->consecutive_incorrect)->toBe(0);
});

test('tracks question statistics', function () {
    $profile = DiagnosticProfile::factory()->create([
        'questions_answered' => 20,
        'questions_correct' => 15,
    ]);

    expect($profile->questions_answered)->toBe(20);
    expect($profile->questions_correct)->toBe(15);
    
    // Can calculate accuracy
    $accuracy = $profile->questions_correct / $profile->questions_answered;
    expect($accuracy)->toBe(0.75);
});