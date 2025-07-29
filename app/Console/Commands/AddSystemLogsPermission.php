<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddSystemLogsPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:add-system-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add missing view system logs permission to roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if permission already exists
        $permission = Permission::where('name', 'view system logs')->first();
        
        if (!$permission) {
            $permission = Permission::create(['name' => 'view system logs']);
            $this->info('Created permission: view system logs');
        } else {
            $this->info('Permission already exists: view system logs');
        }

        // Assign to super-admin role
        $superAdmin = Role::where('name', 'super-admin')->first();
        if ($superAdmin && !$superAdmin->hasPermissionTo('view system logs')) {
            $superAdmin->givePermissionTo('view system logs');
            $this->info('Assigned permission to super-admin role');
        }

        // Assign to admin role
        $admin = Role::where('name', 'admin')->first();
        if ($admin && !$admin->hasPermissionTo('view system logs')) {
            $admin->givePermissionTo('view system logs');
            $this->info('Assigned permission to admin role');
        }

        $this->info('System logs permission setup completed!');
        return 0;
    }
}
