<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticDomain>
 */
class DiagnosticDomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phase_id' => \App\Models\DiagnosticPhase::factory(),
            'phase_order' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->randomElement([
                'Security and Risk Management',
                'Asset Security',
                'Security Architecture and Engineering',
                'Communication and Network Security',
                'Identity and Access Management',
                'Security Assessment and Testing',
                'Security Operations',
                'Software Development Security',
            ]),
            'description' => $this->faker->paragraph(),
            'priority_order' => $this->faker->numberBetween(1, 20),
            'category' => $this->faker->randomElement(['foundational', 'technical', 'managerial']),
            'code' => $this->faker->randomElement(['SRM', 'AS', 'SAE', 'CNS', 'IAM', 'SAT', 'SO', 'SDS']),
            'weight_percentage' => $this->faker->randomFloat(2, 4, 8),
            'color' => $this->faker->randomElement(['blue', 'green', 'orange', 'purple', 'red']),
            'icon' => $this->faker->randomElement(['shield', 'lock', 'network', 'key', 'scan']),
            'is_active' => $this->faker->boolean(90),
            'min_bloom_level' => 1,
            'max_bloom_level' => 5,
            'learning_objectives' => $this->faker->paragraph(),
        ];
    }
}
