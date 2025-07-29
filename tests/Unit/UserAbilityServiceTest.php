<?php

use App\Models\User;
use App\Services\UserAbilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->service = new UserAbilityService();
    $this->user = User::factory()->create();
});

test('get user ability level returns default middle level for V1', function () {
    $abilityLevel = $this->service->getUserAbilityLevel($this->user->id);

    expect($abilityLevel)->toBe(0.5);
});

test('get user ability level accepts domain id parameter', function () {
    $abilityLevel = $this->service->getUserAbilityLevel($this->user->id, 1);

    expect($abilityLevel)->toBe(0.5);
});

test('get user ability level handles null domain id', function () {
    $abilityLevel = $this->service->getUserAbilityLevel($this->user->id, null);

    expect($abilityLevel)->toBe(0.5);
});

test('update abilities from diagnostic results is no-op in V1', function () {
    $diagnosticResults = [
        'domain_1' => ['score' => 0.8, 'questions_answered' => 10],
        'domain_2' => ['score' => 0.6, 'questions_answered' => 8],
    ];

    // Should not throw any exceptions and complete successfully
    $this->service->updateAbilitiesFromDiagnosticResults($this->user, $diagnosticResults);

    // Since it's a no-op, we just verify it doesn't crash
    expect(true)->toBeTrue();
});

test('get recommended starting level returns bloom level 3 for V1', function () {
    $startingLevel = $this->service->getRecommendedStartingLevel($this->user, 1);

    expect($startingLevel)->toBe(3);
});

test('get recommended starting level works with different domain ids', function () {
    $level1 = $this->service->getRecommendedStartingLevel($this->user, 1);
    $level2 = $this->service->getRecommendedStartingLevel($this->user, 2);
    $level3 = $this->service->getRecommendedStartingLevel($this->user, 999);

    expect($level1)->toBe(3);
    expect($level2)->toBe(3);
    expect($level3)->toBe(3);
});

test('service handles multiple users correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $ability1 = $this->service->getUserAbilityLevel($user1->id);
    $ability2 = $this->service->getUserAbilityLevel($user2->id);

    expect($ability1)->toBe(0.5);
    expect($ability2)->toBe(0.5);
});

test('service methods work with user model instance', function () {
    $user = User::factory()->create();
    
    // Test with User model instead of just ID
    $this->service->updateAbilitiesFromDiagnosticResults($user, []);
    $startingLevel = $this->service->getRecommendedStartingLevel($user, 1);

    expect($startingLevel)->toBe(3);
});

test('service is stateless between calls', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // Call methods for user1
    $this->service->getUserAbilityLevel($user1->id, 1);
    $this->service->updateAbilitiesFromDiagnosticResults($user1, ['test' => 'data']);
    $this->service->getRecommendedStartingLevel($user1, 1);

    // Call methods for user2 - should get same results (stateless)
    $ability = $this->service->getUserAbilityLevel($user2->id, 2);
    $startingLevel = $this->service->getRecommendedStartingLevel($user2, 2);

    expect($ability)->toBe(0.5);
    expect($startingLevel)->toBe(3);
});

test('service handles edge cases gracefully', function () {
    // Test with extreme user IDs
    $ability = $this->service->getUserAbilityLevel(0);
    expect($ability)->toBe(0.5);

    $ability = $this->service->getUserAbilityLevel(999999);
    expect($ability)->toBe(0.5);

    // Test with empty diagnostic results
    $this->service->updateAbilitiesFromDiagnosticResults($this->user, []);
    expect(true)->toBeTrue();

    // Test with extreme domain IDs
    $level = $this->service->getRecommendedStartingLevel($this->user, 0);
    expect($level)->toBe(3);

    $level = $this->service->getRecommendedStartingLevel($this->user, -1);
    expect($level)->toBe(3);
});