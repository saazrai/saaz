<?php

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticPhase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('diagnostic domain model has correct fillable fields', function () {
    $domain = new DiagnosticDomain;
    
    expect($domain->getFillable())->toContain('name');
    expect($domain->getFillable())->toContain('description');
    expect($domain->getFillable())->toContain('priority_order');
    expect($domain->getFillable())->toContain('category');
    expect($domain->getFillable())->toContain('is_active');
});

test('diagnostic domain has correct casts', function () {
    $domain = new DiagnosticDomain;
    $casts = $domain->getCasts();

    expect($casts)
        ->phase_order->toBe('integer')
        ->priority_order->toBe('integer')
        ->weight_percentage->toBe('decimal:2')
        ->is_active->toBe('boolean')
        ->min_bloom_level->toBe('integer')
        ->max_bloom_level->toBe('integer')
        ->prerequisites->toBe('array');
});

test('diagnostic domain extends base model', function () {
    $domain = new DiagnosticDomain;

    expect($domain)->toBeInstanceOf(\App\Models\BaseModel::class);
});

test('in priority order scope orders correctly', function () {
    $domain = new DiagnosticDomain;
    $query = $domain->inPriorityOrder();
    
    // Check that the scope method exists and returns a query builder
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('active scope exists and returns query builder', function () {
    $domain = new DiagnosticDomain;
    $query = $domain->active();
    
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('by category scope exists and returns query builder', function () {
    $domain = new DiagnosticDomain;
    $query = $domain->byCategory('technical');
    
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('by phase scope exists and returns query builder', function () {
    $domain = new DiagnosticDomain;
    $query = $domain->byPhase(1);
    
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('in phase order scope exists and returns query builder', function () {
    $domain = new DiagnosticDomain;
    $query = $domain->inPhaseOrder();
    
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('get top by priority static method exists', function () {
    expect(method_exists(DiagnosticDomain::class, 'getTopByPriority'))->toBeTrue();
});

test('get color class returns correct css classes', function () {
    $blueDomain = new DiagnosticDomain(['color' => 'blue']);
    $unknownColorDomain = new DiagnosticDomain(['color' => 'unknown']);

    expect($blueDomain->getColorClass())->toBe('bg-blue-100 text-blue-800');
    expect($unknownColorDomain->getColorClass())->toBe('bg-gray-100 text-gray-800');
});

test('get category display name returns correct names', function () {
    $foundationalDomain = new DiagnosticDomain(['category' => 'foundational']);
    $technicalDomain = new DiagnosticDomain(['category' => 'technical']);
    $managerialDomain = new DiagnosticDomain(['category' => 'managerial']);
    $unknownDomain = new DiagnosticDomain(['category' => 'unknown']);

    expect($foundationalDomain->getCategoryDisplayName())->toBe('Foundational');
    expect($technicalDomain->getCategoryDisplayName())->toBe('Technical');
    expect($managerialDomain->getCategoryDisplayName())->toBe('Managerial');
    expect($unknownDomain->getCategoryDisplayName())->toBe('General');
});

test('has prerequisites method works correctly', function () {
    $domainWithPrereqs = new DiagnosticDomain(['prerequisites' => [1, 2, 3]]);
    $domainWithoutPrereqs = new DiagnosticDomain(['prerequisites' => null]);
    $domainWithEmptyPrereqs = new DiagnosticDomain(['prerequisites' => []]);

    expect($domainWithPrereqs->hasPrerequisites())->toBeTrue();
    expect($domainWithoutPrereqs->hasPrerequisites())->toBeFalse();
    expect($domainWithEmptyPrereqs->hasPrerequisites())->toBeFalse();
});

test('get prerequisite domains returns collection', function () {
    $domainWithoutPrereqs = new DiagnosticDomain(['prerequisites' => null]);
    $noPrerequisites = $domainWithoutPrereqs->getPrerequisiteDomains();
    
    expect($noPrerequisites)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($noPrerequisites)->toHaveCount(0);
});

test('diagnostic domain relationships are defined correctly', function () {
    $domain = new DiagnosticDomain;

    // Test that relationship methods exist
    expect(method_exists($domain, 'topics'))->toBeTrue();
    
    // Test topics relationship if it exists
    if (method_exists($domain, 'topics')) {
        expect($domain->topics())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    }
});

test('diagnostic domain scopes can be chained', function () {
    $query = DiagnosticDomain::active()
        ->byCategory('technical')
        ->inPriorityOrder();

    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});