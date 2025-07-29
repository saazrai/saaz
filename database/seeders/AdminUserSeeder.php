<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Saaz Rai as super admin
        // First, check if user with ID 1 exists
        $superAdmin = User::find(1);
        
        if ($superAdmin) {
            // Update existing user
            $superAdmin->update([
                'name' => 'Saaz Rai',
                'is_active' => true,
            ]);
            $this->command->info('Updated existing user ID: 1 to Saaz Rai');
        } else {
            // Create new user
            $superAdmin = User::create([
                'id' => 1,
                'name' => 'Saaz Rai',
                'email' => 'saaz.rai@gmail.com',
                'password' => Hash::make('password'), // Change this to a secure password
                'email_verified_at' => now(),
                'is_active' => true,
            ]);
            $this->command->info('Created new user: Saaz Rai with ID: 1');
        }

        // Assign super-admin role if not already assigned
        if (!$superAdmin->hasRole('super-admin')) {
            $superAdmin->assignRole('super-admin');
            $this->command->info('Super admin role assigned to Saaz Rai (ID: 1)');
        } else {
            $this->command->info('Saaz Rai already has super-admin role');
        }


        $this->command->info('Admin users seeded successfully!');
    }
}
