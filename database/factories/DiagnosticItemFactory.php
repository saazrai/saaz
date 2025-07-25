<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticItem>
 */
class DiagnosticItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subtopic_id' => \App\Models\DiagnosticSubtopic::factory(),
            'type_id' => 1, // Default to MCQ (Multiple Choice Question)
            'dimension' => $this->faker->randomElement(['Technical', 'Managerial']),
            'content' => $this->faker->sentence().'?',
            'options' => [
                'A' => $this->faker->sentence(),
                'B' => $this->faker->sentence(),
                'C' => $this->faker->sentence(),
                'D' => $this->faker->sentence(),
            ],
            'correct_options' => [$this->faker->randomElement(['A', 'B', 'C', 'D'])],
            'justifications' => [
                'A' => $this->faker->sentence(),
                'B' => $this->faker->sentence(),
                'C' => $this->faker->sentence(),
                'D' => $this->faker->sentence(),
            ],
            'settings' => [
                'time_limit' => $this->faker->numberBetween(30, 180),
                'hints_allowed' => $this->faker->boolean(),
            ],
            'difficulty_level' => $this->faker->numberBetween(1, 6),
            'bloom_level' => $this->faker->numberBetween(1, 6),
            'irt_a' => $this->faker->randomFloat(2, 0.5, 3.0),
            'irt_b' => $this->faker->randomFloat(2, -3.0, 3.0),
            'irt_c' => $this->faker->randomFloat(2, 0.0, 0.5),
            'status' => $this->faker->randomElement(['draft', 'published', 'retired']),
        ];
    }
}
