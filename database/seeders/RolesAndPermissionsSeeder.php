<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            'restore users',
            'force delete users',
            'assign roles',
            
            // Question Bank Management
            'view questions',
            'create questions',
            'edit questions',
            'delete questions',
            'publish questions',
            'review questions',
            
            // Assessment Management
            'view assessments',
            'monitor assessments',
            'export assessments',
            'view assessment details',
            
            // Reports & Analytics
            'view reports',
            'export reports',
            'view analytics',
            
            // System Settings
            'view settings',
            'edit settings',
            'manage system',
            
            // Diagnostic Management
            'manage diagnostic phases',
            
            // Admin Access
            'access admin panel',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - gets all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin - most permissions except system management
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'access admin panel',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'restore users',
            'assign roles',
            'view questions',
            'create questions',
            'edit questions',
            'delete questions',
            'publish questions',
            'view assessments',
            'monitor assessments',
            'export assessments',
            'view assessment details',
            'view reports',
            'export reports',
            'view analytics',
            'view settings',
            'manage diagnostic phases',
        ]);

        // Moderator - limited permissions
        $moderatorRole = Role::create(['name' => 'moderator']);
        $moderatorRole->givePermissionTo([
            'access admin panel',
            'view users',
            'view questions',
            'edit questions',
            'review questions',
            'view assessments',
            'view assessment details',
            'view reports',
        ]);

        // User - default role with no special permissions
        $userRole = Role::create(['name' => 'user']);
        // Users don't need any special permissions - they can take assessments by default

        // Output success message
        $this->command->info('Roles and permissions created successfully!');
        $this->command->table(
            ['Role', 'Permissions Count'],
            [
                ['Super Admin', $superAdminRole->permissions->count()],
                ['Admin', $adminRole->permissions->count()],
                ['Moderator', $moderatorRole->permissions->count()],
                ['User', $userRole->permissions->count()],
            ]
        );
    }
}