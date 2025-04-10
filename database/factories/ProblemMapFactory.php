<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Problem;
use App\Models\ProblemMap;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProblemMap>
 */
class ProblemMapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'region_id'  => Region::inRandomOrder()->value('id'),
        ];
    }
}
