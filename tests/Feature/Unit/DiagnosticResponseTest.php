<?php

use App\Models\DiagnosticResponse;
use App\Models\Diagnostic;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed question types (required for diagnostic items)
    $this->seed(\Database\Seeders\QuestionTypesSeeder::class);
    
    // Create test hierarchy for diagnostic responses
    $this->domain = DiagnosticDomain::factory()->create();
    $this->topic = DiagnosticTopic::factory()->create(['domain_id' => $this->domain->id]);
    $this->item = DiagnosticItem::factory()->create(['topic_id' => $this->topic->id]);
});

test('can create diagnostic response with required fields', function () {
    $diagnostic = Diagnostic::factory()->create();
    
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_id' => $diagnostic->id,
        'diagnostic_item_id' => $this->item->id,
        'user_answer' => ['A'],
        'is_correct' => true,
        'response_time_seconds' => 45.5,
    ]);

    expect($response)
        ->diagnostic_id->toBe($diagnostic->id)
        ->diagnostic_item_id->toBe($this->item->id)
        ->user_answer->toBe(['A'])
        ->is_correct->toBeTrue()
        ->response_time_seconds->toBe(45.5);
});

test('diagnostic response belongs to diagnostic', function () {
    $diagnostic = Diagnostic::factory()->create();
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_id' => $diagnostic->id,
        'diagnostic_item_id' => $this->item->id,
    ]);

    expect($response->diagnostic)
        ->not->toBeNull()
        ->id->toBe($diagnostic->id);
});

test('diagnostic response belongs to diagnostic item', function () {
    $response = DiagnosticResponse::factory()->create(['diagnostic_item_id' => $this->item->id]);

    expect($response->item)
        ->not->toBeNull()
        ->id->toBe($this->item->id);

    expect($response->diagnosticItem)
        ->not->toBeNull()
        ->id->toBe($this->item->id);
});

test('casts user answer as array', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'user_answer' => ['A', 'B', 'C'],
    ]);

    expect($response->user_answer)->toBeArray();
    expect($response->user_answer)->toBe(['A', 'B', 'C']);
});

test('casts is_correct as boolean', function () {
    $response1 = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'is_correct' => true,
    ]);
    $response2 = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'is_correct' => false,
    ]);

    expect($response1->is_correct)->toBeTrue();
    expect($response2->is_correct)->toBeFalse();
});

test('tracks response time accurately', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'response_time_seconds' => 123.456,
    ]);

    expect($response->response_time_seconds)->toBe(123.456);
});

test('diagnostic response audit includes all fields', function () {
    $response = new DiagnosticResponse();

    $auditInclude = $response->getAuditInclude();

    expect($auditInclude)->toContain('diagnostic_id');
    expect($auditInclude)->toContain('diagnostic_item_id');
    expect($auditInclude)->toContain('user_answer');
    expect($auditInclude)->toContain('is_correct');
    expect($auditInclude)->toContain('response_time_seconds');
});

test('diagnostic response soft deletes', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
    ]);
    $id = $response->id;

    $response->delete();

    expect(DiagnosticResponse::find($id))->toBeNull();
    expect(DiagnosticResponse::withTrashed()->find($id))->not->toBeNull();
});

test('handles single answer correctly', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'user_answer' => ['A'],
        'is_correct' => true,
    ]);

    expect($response->user_answer)->toHaveCount(1);
    expect($response->user_answer[0])->toBe('A');
});

test('handles multiple answers for multi-select questions', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'user_answer' => ['A', 'C', 'D'],
        'is_correct' => false,
    ]);

    expect($response->user_answer)->toHaveCount(3);
    expect($response->user_answer)->toContain('A');
    expect($response->user_answer)->toContain('C');
    expect($response->user_answer)->toContain('D');
});

test('tracks quick responses', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'response_time_seconds' => 2.5, // Very quick response
    ]);

    expect($response->response_time_seconds)->toBeLessThan(5);
});

test('tracks slow responses', function () {
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_item_id' => $this->item->id,
        'response_time_seconds' => 180.0, // 3 minutes
    ]);

    expect($response->response_time_seconds)->toBeGreaterThan(60);
});