<?php

use App\Models\Diagnostic;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticPhase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;

uses(DatabaseMigrations::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Create test data
    $this->phase1 = DiagnosticPhase::factory()->create([
        'order_sequence' => 1,
        'name' => 'Foundation & Governance',
    ]);

    $this->domains = DiagnosticDomain::factory()->count(3)->create([
        'phase_id' => $this->phase1->id,
    ]);

    // Seed question types first (required for diagnostic items)
    $this->seed(\Database\Seeders\QuestionTypesSeeder::class);

    // Create topics for each domain, then questions for each topic
    foreach ($this->domains as $domain) {
        $topics = \App\Models\DiagnosticTopic::factory()->count(2)->create([
            'domain_id' => $domain->id,
        ]);

        foreach ($topics as $topic) {
            DiagnosticItem::factory()->count(3)->create([
                'topic_id' => $topic->id,
                'bloom_level' => 3,
            ]);
        }
    }
});

test('user can complete full diagnostic assessment flow', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->type('email', 'test@example.com')
            ->type('password', 'password')
            ->press('LOG IN')
            ->waitForLocation('/dashboard');

        // Start diagnostic assessment
        $browser->visit('/assessments/diagnostics')
            ->waitForText('Diagnostic Assessment')
            ->click('@start-assessment-btn')
            ->waitForLocation('/assessments/diagnostics/start');

        // Begin assessment
        $browser->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Answer questions
        for ($i = 0; $i < 3; $i++) {
            $browser->waitForText('Question')
                ->click('@answer-option-A')
                ->click('@submit-answer-btn')
                ->pause(1000);
        }

        // Check completion
        $browser->waitForText('Assessment Complete')
            ->assertSee('Your Results');
    });
});

test('user can navigate through assessment questions', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Navigate forward
        $browser->click('@answer-option-A')
            ->click('@submit-answer-btn')
            ->waitForText('Question 2');

        // Check progress indicator
        $browser->assertSee('Progress:');
    });
});

test('assessment shows progress indicator', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'current_question' => 5,
        'total_questions' => 20,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForText('Question')
            ->assertSee('5 of 20'); // Progress indicator
    });
});

test('user can pause and resume assessment', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'current_question' => 3,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForText('Question')
            ->click('@pause-assessment-btn')
            ->waitForText('Assessment Paused')
            ->assertSee('Resume Assessment');

        // Resume assessment
        $browser->click('@resume-assessment-btn')
            ->waitForText('Question');
    });
});

test('assessment validates required answers', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Try to submit without selecting answer
        $browser->click('@submit-answer-btn')
            ->waitForText('Please select an answer');
    });
});

test('assessment shows time remaining', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'started_at' => now()->subMinutes(5),
        'time_limit_minutes' => 60,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForText('Question')
            ->assertSee('55:'); // Remaining time
    });
});

test('assessment handles timeout gracefully', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'started_at' => now()->subMinutes(61),
        'time_limit_minutes' => 60,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForText('Time Expired')
            ->assertSee('Your assessment has been automatically submitted');
    });
});

test('user can view detailed results after completion', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'completed',
        'score' => 85.5,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}/results")
            ->waitForText('Assessment Results')
            ->assertSee('85.5%')
            ->assertSee('Performance by Domain');
    });
});

test('user can export results to pdf', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'completed',
        'score' => 75.0,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}/results")
            ->waitForText('Assessment Results')
            ->click('@export-pdf-btn')
            ->pause(2000); // Wait for download

        // Verify download initiated (actual file checking would be environment-specific)
        $browser->assertSee('Assessment Results');
    });
});

test('guest user cannot access assessment directly', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForLocation('/login')
            ->assertSee('Login');
    });
});

test('assessment shows domain-specific questions', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Check domain indicator
        $browser->assertSeeIn('@domain-indicator', $this->domains->first()->name);
    });
});

test('assessment tracks response time', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1')
            ->pause(2000); // Wait 2 seconds

        // Submit answer
        $browser->click('@answer-option-A')
            ->click('@submit-answer-btn')
            ->waitForText('Question 2');

        // Response time should be recorded (we can't easily verify this in browser test)
    });
});

test('assessment supports keyboard navigation', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Use keyboard shortcuts
        $browser->keys('body', ['1']) // Select option A
            ->keys('body', ['{enter}']) // Submit answer
            ->waitForText('Question 2');
    });
});

test('assessment shows confirmation before submission', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Answer multiple questions to get to end
        for ($i = 0; $i < 3; $i++) {
            $browser->click('@answer-option-A')
                ->click('@submit-answer-btn')
                ->pause(500);
        }

        // Final submission should show confirmation
        $browser->waitForText('Submit Assessment')
            ->assertSee('Are you sure you want to submit?');
    });
});

test('assessment handles network errors gracefully', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Simulate network issue by navigating away and back
        $browser->visit('/about')
            ->back()
            ->waitForText('Question 1')
            ->assertSee('Your progress has been saved');
    });
});

test('assessment provides accessibility features', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Check for accessibility attributes
        $browser->assertAttribute('@question-text', 'role', 'main')
            ->assertAttribute('@answer-options', 'role', 'radiogroup');
    });
});

test('assessment displays helpful error messages', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Try invalid action
        $browser->click('@submit-answer-btn')
            ->waitForText('Please select an answer before continuing');
    });
});

test('assessment maintains state during browser refresh', function () {
    $diagnostic = Diagnostic::factory()->create([
        'user_id' => $this->user->id,
        'status' => 'in_progress',
        'current_question' => 3,
    ]);

    $this->browse(function (Browser $browser) use ($diagnostic) {
        $browser->loginAs($this->user)
            ->visit("/assessments/diagnostics/{$diagnostic->id}")
            ->waitForText('Question')
            ->refresh()
            ->waitForText('Question')
            ->assertSee('Question 3'); // State maintained
    });
});

test('assessment shows correct scoring after completion', function () {
    $this->browse(function (Browser $browser) {
        $browser->loginAs($this->user)
            ->visit('/assessments/diagnostics/start')
            ->select('mode', 'standard')
            ->click('@begin-assessment-btn')
            ->waitForText('Question 1');

        // Complete assessment
        for ($i = 0; $i < 3; $i++) {
            $browser->click('@answer-option-A')
                ->click('@submit-answer-btn')
                ->pause(500);
        }

        // Check final results
        $browser->waitForText('Assessment Complete')
            ->assertSee('Your Score:')
            ->assertSee('%');
    });
});
