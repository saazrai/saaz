<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticTopic>
 */
class DiagnosticTopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'domain_id' => \App\Models\DiagnosticDomain::factory(),
            'name' => $this->faker->randomElement([
                'Access Control',
                'Network Security',
                'Risk Assessment',
                'Incident Response',
                'Cryptography',
                'Security Policies',
                'Vulnerability Management',
                'Security Architecture',
            ]),
            'description' => $this->faker->paragraph(),
        ];
    }
}
