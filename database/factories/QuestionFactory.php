<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Survey;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->realText(),
            'type' => 1,
            'survey_id' => Survey::factory(), #->create()->id,

        ];
    }
}
