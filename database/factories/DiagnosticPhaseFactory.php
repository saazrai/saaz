<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticPhase>
 */
class DiagnosticPhaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Foundation & Governance',
                'Risk & Compliance', 
                'Operations & Incident Response',
                'Advanced Security & Development',
            ]),
            'description' => $this->faker->paragraph(),
            'order_sequence' => $this->faker->numberBetween(1, 4),
            'min_questions_per_domain' => $this->faker->numberBetween(5, 10),
            'target_domains' => $this->faker->numberBetween(4, 6),
            'completion_criteria' => [
                'min_score' => $this->faker->numberBetween(60, 80),
                'required_domains' => $this->faker->numberBetween(3, 5),
            ],
            'is_active' => $this->faker->boolean(95),
            'color' => $this->faker->randomElement(['blue', 'green', 'orange', 'purple']),
            'icon' => $this->faker->randomElement(['shield', 'lock', 'cog', 'chart']),
        ];
    }
}
