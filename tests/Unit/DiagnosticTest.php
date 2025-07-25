<?php

use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticPhase;
use App\Models\DiagnosticResponse;
use App\Models\DiagnosticTopic;
use App\Models\User;
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

test('can create diagnostic with required fields', function () {
    $user = User::factory()->create();

    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $user->id,
        'status' => 'in_progress',
        'phase_id' => null,
        'adaptive_state' => ['bloom_level' => 1, 'confidence' => 0.5],
    ]);

    expect($diagnostic)
        ->user_id->toBe($user->id)
        ->status->toBe('in_progress')
        ->phase_id->toBeNull()
        ->adaptive_state->toBe(['bloom_level' => 1, 'confidence' => 0.5]);
});

test('diagnostic belongs to user', function () {
    $user = User::factory()->create();
    $diagnostic = Diagnostic::factory()->create(['user_id' => $user->id]);

    expect($diagnostic->user)
        ->not->toBeNull()
        ->id->toBe($user->id);
});

test('diagnostic has many responses', function () {
    $diagnostic = Diagnostic::factory()->create();
    $response = DiagnosticResponse::factory()->create([
        'diagnostic_id' => $diagnostic->id,
        'diagnostic_item_id' => $this->item->id,
    ]);

    expect($diagnostic->responses)
        ->toHaveCount(1)
        ->first()->id->toBe($response->id);
});

test('can check if phase is completed', function () {
    $user = User::factory()->create();
    $phase1 = DiagnosticPhase::factory()->create(['order_sequence' => 1]);
    $phase2 = DiagnosticPhase::factory()->create(['order_sequence' => 2]);
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $user->id,
        'phase_id' => $phase2->id, // Current phase is phase2
    ]);

    expect($diagnostic->isPhaseCompleted($phase1->id))->toBeTrue(); // phase1 is before phase2
    expect($diagnostic->isPhaseCompleted($phase2->id))->toBeFalse(); // phase2 is current
    $phase3 = DiagnosticPhase::factory()->create(['order_sequence' => 3]);
    expect($diagnostic->isPhaseCompleted($phase3->id))->toBeFalse(); // phase3 is after phase2
});

test('can get phase progress', function () {
    $diagnostic = Diagnostic::factory()->create();
    $progress = $diagnostic->getPhaseProgress(1);
    expect($progress)
        ->domains_completed->toBe(0)
        ->questions_answered->toBe(0)
        ->started_at->toBeNull()
        ->completed_at->toBeNull();
});

test('returns default phase progress when not exists', function () {
    $diagnostic = Diagnostic::factory()->create();

    $progress = $diagnostic->getPhaseProgress(1);

    expect($progress)
        ->domains_completed->toBe(0)
        ->questions_answered->toBe(0)
        ->started_at->toBeNull()
        ->completed_at->toBeNull();
});

test('duration minutes calculation', function () {
    $diagnostic = Diagnostic::factory()->create([
        'total_duration_seconds' => 3600, // 1 hour
    ]);

    expect($diagnostic->duration_minutes)->toBe(60);
});

test('duration minutes returns null when no duration', function () {
    $diagnostic = Diagnostic::factory()->create([
        'total_duration_seconds' => null,
    ]);

    expect($diagnostic->duration_minutes)->toBeNull();
});

test('diagnostic casts arrays correctly', function () {
    $diagnostic = Diagnostic::factory()->create([
        'adaptive_state' => ['bloom_level' => 3, 'confidence' => 0.8],
    ]);
    expect($diagnostic->adaptive_state)->toBeArray();
    expect($diagnostic->adaptive_state['bloom_level'])->toBe(3);
});

test('diagnostic audit includes important fields', function () {
    $diagnostic = new Diagnostic;
    $auditInclude = $diagnostic->getAuditInclude();
    expect($auditInclude)->toContain('status');
    expect($auditInclude)->toContain('score');
    expect($auditInclude)->toContain('phase_id');
    expect($auditInclude)->toContain('completed_at');
});

test('diagnostic soft deletes', function () {
    $diagnostic = Diagnostic::factory()->create();
    $id = $diagnostic->id;

    $diagnostic->delete();

    expect(Diagnostic::find($id))->toBeNull();
    expect(Diagnostic::withTrashed()->find($id))->not->toBeNull();
});
