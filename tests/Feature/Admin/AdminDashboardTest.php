<?php

use App\Models\User;
use App\Models\Diagnostic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Disable problematic middleware for testing
    $this->withoutMiddleware([
        \App\Http\Middleware\CheckCookieConsent::class,
        \App\Http\Middleware\CheckUserActive::class,
    ]);
    
    // Create permissions
    Permission::create(['name' => 'access admin panel']);
    Permission::create(['name' => 'view users']);
    Permission::create(['name' => 'manage users']);
    
    // Create admin role with permissions
    $this->adminRole = Role::create(['name' => 'admin']);
    $this->adminRole->givePermissionTo(['access admin panel', 'view users', 'manage users']);
    
    // Create regular user role
    $this->userRole = Role::create(['name' => 'user']);
    
    // Create admin user
    $this->adminUser = User::factory()->create([
        'email' => 'admin@example.com',
        'is_active' => true,
    ]);
    $this->adminUser->assignRole('admin');
    
    // Create regular user
    $this->regularUser = User::factory()->create([
        'email' => 'user@example.com',
        'is_active' => true,
    ]);
    $this->regularUser->assignRole('user');
});

test('admin dashboard requires authentication', function () {
    $response = $this->get(route('admin.dashboard'));
    
    $response->assertRedirect(route('login'));
});

test('admin dashboard requires admin permission', function () {
    $response = $this->actingAs($this->regularUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(404); // AdminAccess middleware returns 404 for unauthorized access
});

test('admin dashboard displays correctly for admin user', function () {
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->component('Admin/Dashboard')
             ->has('stats')
             ->has('recentUsers')
             ->has('recentAssessments')
             ->has('completionData')
             ->has('roleDistribution')
    );
});

test('admin dashboard stats are calculated correctly', function () {
    // Create test data
    $additionalUsers = User::factory()->count(5)->create(['is_active' => true]);
    User::factory()->count(2)->create(['is_active' => false]);
    
    $completedDiagnostics = Diagnostic::factory()->count(3)->create([
        'user_id' => $this->regularUser->id,
        'status' => 'completed',
        'score' => 85.5
    ]);
    
    $inProgressDiagnostics = Diagnostic::factory()->count(2)->create([
        'user_id' => $this->regularUser->id,
        'status' => 'in_progress'
    ]);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('stats')
             ->where('stats.total_users', 9) // adminUser + regularUser + 5 additional + 2 inactive
             ->where('stats.active_users', 7) // adminUser + regularUser + 5 additional (not the 2 inactive)
             ->where('stats.total_assessments', 5) // 3 completed + 2 in_progress
             ->where('stats.completed_assessments', 3)
             ->where('stats.average_score', 85.5)
    );
});

test('admin dashboard shows recent users', function () {
    // Create some recent users
    $recentUsers = User::factory()->count(3)->create();
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('recentUsers', 5) // Should have 5 recent users (including existing ones)
             ->has('recentUsers.0', fn ($user) =>
                 $user->has('id')
                      ->has('name')
                      ->has('email')
                      ->has('created_at')
                      ->has('last_login_at')
             )
    );
});

test('admin dashboard shows recent assessments', function () {
    // Create some recent assessments
    $assessments = Diagnostic::factory()->count(3)->create([
        'user_id' => $this->regularUser->id,
        'status' => 'completed',
        'score' => 90.0
    ]);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('recentAssessments', 3)
             ->has('recentAssessments.0', fn ($assessment) =>
                 $assessment->has('id')
                           ->has('user_id')
                           ->has('score')
                           ->has('status')
                           ->has('created_at')
                           ->has('user', fn ($user) =>
                               $user->has('id')
                                    ->has('name')
                                    ->has('email')
                           )
             )
    );
});

test('admin dashboard handles inactive user account', function () {
    // Re-enable CheckUserActive middleware for this specific test
    $this->withMiddleware([
        \App\Http\Middleware\CheckUserActive::class,
    ]);
    
    // Make admin user inactive
    $this->adminUser->update(['is_active' => false]);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error', 'Your account has been deactivated. Please contact support.');
    
    // User should be logged out
    $this->assertGuest();
});

test('admin dashboard completion data structure is correct', function () {
    // Create assessments from different days
    $yesterday = now()->subDay();
    $twoDaysAgo = now()->subDays(2);
    
    Diagnostic::factory()->create([
        'user_id' => $this->regularUser->id,
        'status' => 'completed',
        'created_at' => $yesterday
    ]);
    
    Diagnostic::factory()->create([
        'user_id' => $this->regularUser->id,
        'status' => 'in_progress',
        'created_at' => $yesterday
    ]);
    
    Diagnostic::factory()->create([
        'user_id' => $this->regularUser->id,
        'status' => 'completed',
        'created_at' => $twoDaysAgo
    ]);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('completionData')
    );
});

test('admin dashboard role distribution is calculated', function () {
    // Create users with different roles
    $moderatorRole = Role::create(['name' => 'moderator']);
    $moderatorRole->givePermissionTo('access admin panel');
    
    $moderatorUser = User::factory()->create();
    $moderatorUser->assignRole('moderator');
    
    $userWithoutRole = User::factory()->create();
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('roleDistribution')
    );
});

test('admin dashboard rate limits unauthorized access attempts', function () {
    // Try to access admin dashboard multiple times with regular user
    for ($i = 0; $i < 6; $i++) {
        $response = $this->actingAs($this->regularUser)
            ->get(route('admin.dashboard'));
            
        if ($i < 5) {
            $response->assertStatus(404);
        } else {
            // 6th attempt should be rate limited
            $response->assertStatus(429);
        }
    }
});

test('admin dashboard logs unauthorized access attempts', function () {
    // Mock the Log facade to verify logging
    Log::shouldReceive('channel')->with('security')->andReturnSelf();
    Log::shouldReceive('warning')->once();
    // Allow Laravel's exception handler to log errors without failing
    Log::shouldReceive('error')->zeroOrMoreTimes();
    Log::shouldReceive('debug')->zeroOrMoreTimes();
    Log::shouldReceive('info')->zeroOrMoreTimes();
    
    $response = $this->actingAs($this->regularUser)
        ->get(route('admin.dashboard'));
        
    $response->assertStatus(404);
});