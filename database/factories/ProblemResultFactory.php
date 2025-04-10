<?php

namespace Database\Factories;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProblemResult>
 */
class ProblemResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::inRandomOrder()->value('id'),
            'result'     => $this->faker->text,
            'status'     => $this->faker->text
        ];
    }
}
