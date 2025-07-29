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
        try {
            // Create or find Saaz Rai as super admin - use email as unique identifier instead of ID
            $superAdmin = User::firstOrCreate(
                ['email' => 'saaz.rai@gmail.com'], // Search criteria
                [
                    'name' => 'Saaz Rai',
                    'password' => Hash::make('SecureAdminPassword123!'), // Secure default password
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]
            );
            
            // Ensure user is active
            if (!$superAdmin->is_active) {
                $superAdmin->update(['is_active' => true]);
                $this->command->info('Activated existing user: Saaz Rai');
            }

            // Check if super-admin role exists before assigning
            if (\Spatie\Permission\Models\Role::where('name', 'super-admin')->exists()) {
                // Assign super-admin role if not already assigned
                if (!$superAdmin->hasRole('super-admin')) {
                    $superAdmin->assignRole('super-admin');
                    $this->command->info('Super admin role assigned to Saaz Rai');
                } else {
                    $this->command->info('Saaz Rai already has super-admin role');
                }
            } else {
                $this->command->warn('Super-admin role does not exist. Make sure RolesAndPermissionsSeeder runs first.');
            }

            $this->command->info('Admin users seeded successfully!');
            
        } catch (\Exception $e) {
            $this->command->error('Admin user seeding failed: ' . $e->getMessage());
            // Don't throw the exception to prevent deployment failure
            // Log the error instead
            \Log::error('Admin user seeding failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
