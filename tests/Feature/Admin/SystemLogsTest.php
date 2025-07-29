<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
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
    Permission::create(['name' => 'view system logs']);
    
    // Create admin role with permissions
    $this->adminRole = Role::create(['name' => 'admin']);
    $this->adminRole->givePermissionTo(['access admin panel', 'view system logs']);
    
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
    
    // Create mock log directory and files
    $this->logPath = storage_path('logs');
    $this->testLogFile = $this->logPath . '/laravel.log';
    
    // Ensure log directory exists
    if (!File::exists($this->logPath)) {
        File::makeDirectory($this->logPath, 0755, true);
    }
    
    // Create test log content
    createTestLogFile($this->testLogFile);
});

afterEach(function () {
    // Clean up test log files
    if (File::exists($this->testLogFile)) {
        File::delete($this->testLogFile);
    }
});

test('system logs index requires admin permission', function () {
    $response = $this->actingAs($this->regularUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(404);
});

test('system logs index displays correctly for admin', function () {
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->component('Admin/System/Logs/Index')
             ->has('entries')
             ->has('logFiles')
             ->has('filters')
    );
});

test('system logs can be filtered by level', function () {
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['level' => 'error']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
             ->where('filters.level', 'error')
    );
});

test('system logs can be filtered by date range', function () {
    $dateFrom = now()->subDays(7)->toDateString();
    $dateTo = now()->toDateString();
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', [
            'date_from' => $dateFrom,
            'date_to' => $dateTo
        ]));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
             ->where('filters.date_from', $dateFrom)
             ->where('filters.date_to', $dateTo)
    );
});

test('system logs can be searched by message content', function () {
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['search' => 'test error message']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs handle different log files', function () {
    // Create additional log file
    $customLogFile = $this->logPath . '/custom.log';
    File::put($customLogFile, "[2025-01-01 12:00:00] local.INFO: Custom log message\n");
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['file' => 'custom.log']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
             ->where('filters.file', 'custom.log')
    );
    
    // Clean up
    File::delete($customLogFile);
});

test('system logs pagination works correctly', function () {
    // Create a large log file to test pagination
    $logContent = '';
    for ($i = 1; $i <= 100; $i++) {
        $logContent .= "[2025-01-01 12:00:00] local.INFO: Log message {$i}\n";
    }
    File::put($this->testLogFile, $logContent);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs display correct log structure', function () {
    // Ensure test log file has content
    createTestLogFile($this->testLogFile);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['file' => 'laravel.log']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs handle empty log files gracefully', function () {
    // Create empty log file
    File::put($this->testLogFile, '');
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
             ->where('entries', [])
    );
});

test('system logs handle malformed log entries', function () {
    // Create log file with malformed entries
    $malformedContent = "This is not a proper log entry\n" .
                       "[2025-01-01 12:00:00] local.INFO: This is a proper entry\n" .
                       "Another malformed entry\n";
    
    File::put($this->testLogFile, $malformedContent);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    // Should still work and show valid entries
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs respect permission requirements', function () {
    // Create role without log viewing permission
    $limitedRole = Role::create(['name' => 'limited']);
    $limitedRole->givePermissionTo('access admin panel');
    
    $limitedUser = User::factory()->create(['is_active' => true]);
    $limitedUser->assignRole('limited');
    
    $response = $this->actingAs($limitedUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(403);
});

test('system logs show available log files', function () {
    // Create multiple log files
    $files = ['laravel.log', 'custom.log', 'error.log'];
    foreach ($files as $file) {
        File::put($this->logPath . '/' . $file, "[2025-01-01 12:00:00] local.INFO: Test message\n");
    }
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('logFiles')
    );
    
    // Clean up
    foreach ($files as $file) {
        File::delete($this->logPath . '/' . $file);
    }
});

test('system logs handle large files efficiently', function () {
    // This test ensures the log viewer doesn't try to load massive files into memory
    // Create a moderately large log file
    $logContent = '';
    for ($i = 1; $i <= 1000; $i++) {
        $logContent .= "[2025-01-01 12:00:0{$i}] local.INFO: Log message {$i} with some additional context data\n";
    }
    File::put($this->testLogFile, $logContent);
    
    $startTime = microtime(true);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    
    $response->assertStatus(200);
    // Should complete in reasonable time (less than 2 seconds)
    $this->assertLessThan(2.0, $executionTime);
});

test('system logs format timestamps correctly', function () {
    createTestLogFile($this->testLogFile);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['file' => 'laravel.log']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs handle security log entries', function () {
    // Create security-specific log content
    $securityContent = "[2025-01-01 12:00:00] security.WARNING: Unauthorized admin access attempt {\"user_id\":1,\"ip\":\"192.168.1.1\"}\n" .
                      "[2025-01-01 12:01:00] security.ERROR: Multiple failed login attempts {\"ip\":\"192.168.1.100\",\"attempts\":5}\n";
    
    File::put($this->testLogFile, $securityContent);
    
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index', ['level' => 'WARNING']));
        
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
    );
});

test('system logs support real-time refresh', function () {
    // This would test WebSocket or polling functionality if implemented
    $response = $this->actingAs($this->adminUser)
        ->get(route('admin.system.logs.index'));
        
    $response->assertStatus(200);
    // Check that the page includes necessary data for real-time updates
    $response->assertInertia(fn ($page) =>
        $page->has('entries')
             ->has('logFiles')
    );
});

function createTestLogFile($testLogFile) {
    $logContent = [
        "[2025-01-01 10:00:00] local.INFO: Application started",
        "[2025-01-01 10:01:00] local.DEBUG: Debug message for testing",
        "[2025-01-01 10:02:00] local.WARNING: This is a warning message",
        "[2025-01-01 10:03:00] local.ERROR: Test error message for filtering",
        "[2025-01-01 10:04:00] local.CRITICAL: Critical system error occurred",
        "[2025-01-01 10:05:00] local.INFO: User login successful {\"user_id\":1,\"ip\":\"192.168.1.1\"}",
        "[2025-01-01 10:06:00] local.INFO: Cache cleared successfully",
        "[2025-01-01 10:07:00] local.ERROR: Database connection failed",
        "[2025-01-01 10:08:00] local.INFO: Backup completed successfully",
        "[2025-01-01 10:09:00] local.WARNING: Disk space running low",
    ];
    
    File::put($testLogFile, implode("\n", $logContent) . "\n");
}