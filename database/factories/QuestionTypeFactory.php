<?php

namespace Database\Factories;

use App\Models\QuestionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionType>
 */
class QuestionTypeFactory extends Factory
{
    protected $model = QuestionType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $questionTypes = [
            'Multiple Choice' => 'MC',
            'True/False' => 'TF',
            'Fill in the Blank' => 'FB',
            'Essay' => 'ES',
            'Matching' => 'MA',
            'Ordering' => 'OR',
            'Drag and Drop' => 'DD',
            'Short Answer' => 'SA'
        ];
        
        $selectedType = $this->faker->randomElement(array_keys($questionTypes));
        
        return [
            'name' => $selectedType . ' ' . $this->faker->unique()->numberBetween(1000, 9999),
            'code' => $questionTypes[$selectedType] . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->sentence(10),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the question type is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the question type is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Create a multiple choice question type.
     */
    public function multipleChoice(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Multiple Choice',
            'code' => 'MC',
            'description' => 'Questions with multiple answer options where one or more can be correct.',
        ]);
    }

    /**
     * Create a true/false question type.
     */
    public function trueFalse(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'True/False',
            'code' => 'TF',
            'description' => 'Simple binary choice questions.',
        ]);
    }

    /**
     * Create an essay question type.
     */
    public function essay(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Essay',
            'code' => 'ES',
            'description' => 'Open-ended questions requiring written responses.',
        ]);
    }
}