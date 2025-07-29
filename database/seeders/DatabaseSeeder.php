<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call([
            RolesAndPermissionsSeeder::class,   // Must come first - creates roles and permissions
        ]);

        // Seed admin users
        $this->call([
            AdminUserSeeder::class,             // Creates Saaz Rai as super-admin and other admin users
        ]);

        // Seed diagnostic system
        $this->call([
            BloomSeeder::class,                 // Must come first - creates bloom levels
            QuestionTypesSeeder::class,         // Creates question types
            DiagnosticsSeeder::class,           // Creates domains and topics
            DiagnosticSubtopicsSeeder::class,   // Creates subtopics for topics
            DiagnosticPhasesSeeder::class,      // Creates phases and links domains
            DiagnosticItemsSeeder::class,       // Creates questions for all domains
        ]);
    }
}
