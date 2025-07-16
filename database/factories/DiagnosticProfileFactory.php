<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticProfile>
 */
class DiagnosticProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'domain_id' => \App\Models\DiagnosticDomain::factory(),
            'proficiency' => $this->faker->randomFloat(2, 0, 1),
            'last_bloom_level' => $this->faker->numberBetween(1, 5),
            'questions_answered' => $this->faker->numberBetween(0, 50),
            'correct_answers' => $this->faker->numberBetween(0, 25),
            'consecutive_correct' => $this->faker->numberBetween(0, 10),
            'consecutive_incorrect' => $this->faker->numberBetween(0, 5),
            'avg_response_time' => $this->faker->randomFloat(2, 5, 120),
            'last_assessed_at' => $this->faker->optional()->dateTimeBetween('-1 month'),
            'performance_data' => [
                'bloom_1' => $this->faker->randomFloat(2, 0, 1),
                'bloom_2' => $this->faker->randomFloat(2, 0, 1),
                'bloom_3' => $this->faker->randomFloat(2, 0, 1),
                'bloom_4' => $this->faker->randomFloat(2, 0, 1),
                'bloom_5' => $this->faker->randomFloat(2, 0, 1),
            ],
        ];
    }
}
