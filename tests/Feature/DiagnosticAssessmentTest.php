<?php

use App\Models\User;
use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticPhase;
use App\Models\DiagnosticTopic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    
    // Seed question types first (required for diagnostic items)
    $this->seed(\Database\Seeders\QuestionTypesSeeder::class);
    
    // Create phases and domains
    $this->phase1 = DiagnosticPhase::factory()->create([
        'order_sequence' => 1,
        'name' => 'Foundation & Governance',
    ]);
    
    $this->domains = DiagnosticDomain::factory()->count(5)->create([
        'phase_id' => $this->phase1->id,
    ]);
    
    // Create topics for each domain, then questions for each topic
    foreach ($this->domains as $domain) {
        $topics = \App\Models\DiagnosticTopic::factory()->count(2)->create([
            'domain_id' => $domain->id,
        ]);
        
        foreach ($topics as $topic) {
            DiagnosticItem::factory()->count(5)->create([
                'topic_id' => $topic->id,
                'bloom_level' => 3, // Apply level
            ]);
        }
    }
});

test('authenticated user can access diagnostic index', function () {
    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page->component('Diagnostics/Index'));
});

test('guest user cannot access diagnostic index', function () {
    $response = $this->get(route('assessments.diagnostics.index'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
});

test('authenticated user can start new diagnostic', function () {
    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.start'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page->component('Diagnostics/Start'));
});

test('can begin diagnostic assessment', function () {
    $response = $this->actingAs($this->user)
        ->post(route('assessments.diagnostics.begin'), [
            'mode' => 'standard',
        ]);

    $response->assertStatus(302);
    
    // Should create a new diagnostic
    $diagnostic = Diagnostic::where('user_id', $this->user->id)->first();
    expect($diagnostic)->not->toBeNull();
    expect($diagnostic->status)->toBe('in_progress');
    expect($diagnostic->phase->order_sequence)->toBe(1);
});

test('diagnostic assessment shows questions', function () {
    $phase = \App\Models\DiagnosticPhase::factory()->create(['order_sequence' => 1]);
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'phase_id' => $phase->id,
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.show', $diagnostic));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Diagnostics/Assessment')
        ->has('diagnostic')
        ->where('diagnostic.id', $diagnostic->id)
    );
});

test('can submit answer to diagnostic question', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
    ]);
    
    $item = DiagnosticItem::factory()->create([
        'topic_id' => $this->domains->first()->id,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('assessments.diagnostics.submit', $diagnostic), [
            'question_id' => $item->id,
            'answer' => ['A'],
            'response_time' => 45.5,
        ]);

    $response->assertStatus(302);
    
    // Should create a response
    $this->assertDatabaseHas('diagnostic_responses', [
        'diagnostic_id' => $diagnostic->id,
        'diagnostic_item_id' => $item->id,
    ]);
});

test('can view diagnostic results after completion', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'completed',
        'score' => 75.5,
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.results', $diagnostic));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Diagnostics/Results')
        ->has('diagnostic')
        ->where('diagnostic.id', $diagnostic->id)
    );
});

test('cannot view results of incomplete diagnostic', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.results', $diagnostic));

    $response->assertStatus(302);
    $response->assertRedirect(route('assessments.diagnostics.show', $diagnostic));
});

test('cannot access another users diagnostic', function () {
    $otherUser = User::factory()->create();
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.show', $diagnostic));

    $response->assertStatus(403);
});

test('diagnostic tracks phase progression', function () {
    $phase1 = \App\Models\DiagnosticPhase::factory()->create(['order_sequence' => 1]);
    $phase2 = \App\Models\DiagnosticPhase::factory()->create(['order_sequence' => 2]);
    
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'phase_id' => $phase1->id,
    ]);

    // Complete phase 1
    $response = $this->actingAs($this->user)
        ->post(route('assessments.diagnostics.continue-phase', $diagnostic), [
            'completed_phase' => 1,
        ]);

    $response->assertStatus(302);
    
    $diagnostic->refresh();
    expect($diagnostic->phase_id)->toBe($phase2->id);
});

test('prevents starting new diagnostic when one is in progress', function () {
    // Create existing in-progress diagnostic
    Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('assessments.diagnostics.begin'), [
            'mode' => 'standard',
        ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors();
    
    // Should only have one diagnostic
    expect(Diagnostic::where('user_id', $this->user->id)->count())->toBe(1);
});

test('can resume incomplete diagnostic', function () {
    $phase = \App\Models\DiagnosticPhase::factory()->create(['order_sequence' => 2]);
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'phase_id' => $phase->id,
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('assessments.diagnostics.show', $diagnostic));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->where('diagnostic.phase_id', $phase->id)
    );
});

test('diagnostic calculates progress correctly', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'total_questions' => 100,
    ]);
    
    // Create 25 answered responses
    for ($i = 0; $i < 25; $i++) {
        DiagnosticResponse::factory()->create([
            'diagnostic_id' => $diagnostic->id,
            'user_answer' => json_encode(['A']),
            'is_correct' => true,
        ]);
    }

    $answeredCount = $diagnostic->responses()->whereNotNull('user_answer')->count();
    $progress = ($answeredCount / $diagnostic->total_questions) * 100;
    
    expect($progress)->toBe(25.0);
});

test('diagnostic stores adaptive state', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'adaptive_state' => [
            'current_bloom_level' => 3,
            'confidence' => 0.75,
            'questions_answered' => 5,
        ],
    ]);

    expect($diagnostic->adaptive_state['current_bloom_level'])->toBe(3);
    expect($diagnostic->adaptive_state['confidence'])->toBe(0.75);
    expect($diagnostic->adaptive_state['questions_answered'])->toBe(5);
});