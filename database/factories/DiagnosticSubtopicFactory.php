<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticSubtopic>
 */
class DiagnosticSubtopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic_id' => \App\Models\DiagnosticTopic::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}