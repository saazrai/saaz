<?php

namespace Database\Factories;

use App\Models\Diagnostic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnostic>
 */
class DiagnosticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['in_progress', 'completed']),
            'score' => $this->faker->optional()->randomFloat(2, 0, 100),
            'phase_id' => \App\Models\DiagnosticPhase::factory(),
            'total_questions' => $this->faker->numberBetween(50, 200),
            'total_duration_seconds' => $this->faker->optional()->numberBetween(600, 7200),
            'completed_at' => null,
            'ability' => $this->faker->optional()->randomFloat(4, -4, 4),
            'standard_error' => $this->faker->optional()->randomFloat(4, 0, 2),
            'adaptive_state' => [
                'current_bloom_level' => $this->faker->numberBetween(1, 5),
                'confidence' => $this->faker->randomFloat(2, 0, 1),
                'questions_answered' => $this->faker->numberBetween(0, 50),
                'domain_id' => $this->faker->numberBetween(1, 20),
            ],
        ];
    }

    /**
     * Indicate that the diagnostic is not started.
     */
    public function notStarted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress', // Use 'in_progress' since 'not_started' is not in the schema enum
            'score' => null,
        ]);
    }

    /**
     * Indicate that the diagnostic is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'score' => null,
        ]);
    }

    /**
     * Indicate that the diagnostic is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'score' => $this->faker->randomFloat(2, 40, 100),
        ]);
    }
}
