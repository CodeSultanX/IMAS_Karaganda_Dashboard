<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->withFaker()->title,
            'f_date'      => $this->withFaker()->date('Y-m-d'),
            's_date'      => $this->withFaker()->date('Y-m-d'),
            'user_id'     => User::inRandomOrder()->value('id'),
            'news_smi'    => $this->withFaker()->text,
            'news_social' => $this->withFaker()->text,
            'stat_smi'    => $this->withFaker()->randomNumber(4,false),
            'stat_social' => $this->withFaker()->randomNumber(4,false),
            'stat_neg'    => $this->withFaker()->randomNumber(4,false),
            'stat_pos'    => $this->withFaker()->randomNumber(4,false),
            'stat_neu'    => $this->withFaker()->randomNumber(4,false),
            'stat_all'    => $this->withFaker()->randomNumber(4,false),
        ];
    }
}
