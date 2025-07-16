<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticResponse>
 */
class DiagnosticResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isCorrect = $this->faker->boolean(70);
        $correctAnswer = $this->faker->randomElement(['A', 'B', 'C', 'D']);
        
        return [
            'diagnostic_id' => \App\Models\Diagnostic::factory(),
            'diagnostic_item_id' => \App\Models\DiagnosticItem::factory(),
            'user_answer' => $isCorrect ? [$correctAnswer] : [$this->faker->randomElement(['A', 'B', 'C', 'D'])],
            'is_correct' => $isCorrect,
            'response_time_seconds' => $this->faker->randomFloat(2, 5, 180),
            'bloom_level' => $this->faker->numberBetween(1, 5),
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'domain_id' => \App\Models\DiagnosticDomain::factory(),
            'confidence_level' => $this->faker->randomFloat(2, 0, 1),
            'answered_at' => $this->faker->dateTimeBetween('-1 week'),
        ];
    }
}
