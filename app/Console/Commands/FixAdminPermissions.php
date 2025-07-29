<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FixAdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:fix-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix admin role permissions - add missing manage permissions permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Fixing admin role permissions...');

        try {
            // Get the admin role
            $adminRole = Role::where('name', 'admin')->first();
            
            if (!$adminRole) {
                $this->error('❌ Admin role not found!');
                return 1;
            }

            // Check if the permission exists
            $managePermissionsPermission = Permission::where('name', 'manage permissions')->first();
            
            if (!$managePermissionsPermission) {
                $this->error('❌ "manage permissions" permission not found!');
                return 1;
            }

            // Check if admin already has this permission
            if ($adminRole->hasPermissionTo('manage permissions')) {
                $this->info('✅ Admin role already has "manage permissions" permission');
                return 0;
            }

            // Give the permission to admin role
            $adminRole->givePermissionTo('manage permissions');
            $this->info('✅ Added "manage permissions" permission to admin role');

            // Show current admin permissions
            $permissions = $adminRole->permissions->pluck('name')->sort();
            $this->info('📋 Admin role now has ' . $permissions->count() . ' permissions:');
            foreach ($permissions as $permission) {
                $this->line('   - ' . $permission);
            }

            $this->info('🎉 Admin permissions fixed successfully!');
            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Error fixing permissions: ' . $e->getMessage());
            return 1;
        }
    }
}