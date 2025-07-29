<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@securestart.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        // Assign super-admin role
        if (!$superAdmin->hasRole('super-admin')) {
            $superAdmin->assignRole('super-admin');
            $this->command->info('Super Admin role assigned to admin@securestart.com');
        }

        // Create regular admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        // Assign admin role
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
            $this->command->info('Admin role assigned to admin@example.com');
        }

        // Create moderator user
        $moderator = User::firstOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name' => 'Moderator User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        // Assign moderator role
        if (!$moderator->hasRole('moderator')) {
            $moderator->assignRole('moderator');
            $this->command->info('Moderator role assigned to moderator@example.com');
        }

        $this->command->info('Admin users created successfully!');
        $this->command->table(
            ['Email', 'Role', 'Password'],
            [
                ['admin@securestart.com', 'Super Admin', 'password'],
                ['admin@example.com', 'Admin', 'password'],
                ['moderator@example.com', 'Moderator', 'password'],
            ]
        );
    }
}