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
        // Only create test user in non-production environments
        if (app()->environment('local', 'testing')) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed diagnostic system
        $this->call([
            QuestionTypesSeeder::class,         // Must come first - creates question types
            DiagnosticsSeeder::class,           // Creates domains and topics
            DiagnosticSubtopicsSeeder::class,   // Creates subtopics for topics
            DiagnosticPhasesSeeder::class,      // Creates phases and links domains
            DiagnosticItemsSeeder::class,       // Creates questions for all domains
        ]);
    }
}
