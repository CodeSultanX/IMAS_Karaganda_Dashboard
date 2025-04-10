<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Problem>
 */
class ProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'      => $this->withFaker()->title,
            'level'      => $this->faker->randomElement(['republic','obl','city',1,2,3,4,5,6]),
            'color'      => $this->faker->randomElement(['warning','danger','yellow','neu']),
            'project_id' => Project::inRandomOrder()->value('id'),
        ];
    }
}
