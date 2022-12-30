<?php

namespace Database\Factories;

use App\Models\Question;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence,
            'result' => $this->faker->numberBetween(0, 1000),
        ];
    }

    public function withParams($questionId, $result)
    {
        return $this->state([
            'question_id' => $questionId,
            'result' => $result,
            'body' => $this->faker->sentence,
        ]);
    }
}
