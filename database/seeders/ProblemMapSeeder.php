<?php

namespace Database\Seeders;

use App\Models\Problem;
use App\Models\ProblemMap;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProblemMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problem_ids = Problem::pluck('id');
        foreach ($problem_ids as $problem_id) {
            $count = rand(1,3);
            ProblemMap::factory()
            ->count($count)
            ->create([
                'problem_id' => $problem_id,
            ]);
        }
    }
}
