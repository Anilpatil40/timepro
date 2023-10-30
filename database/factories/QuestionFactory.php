<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
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
        $options = [$this->faker->word,$this->faker->word,$this->faker->word,$this->faker->word,];
        return [
            'question' => $this->faker->sentence,
            'a' => $options[0],
            'b' => $options[1],
            'c' => $options[2],
            'd' => $options[3],
            'answer' => $options[array_rand($options)],
            'sectors' => '1,2,3,4',
        ];
    }
}
