<?php

namespace Database\Seeders;

use App\Models\Problem;
use App\Models\ProblemResult;
use Illuminate\Database\Seeder;

class ProblemResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problem_ids = Problem::pluck('id');
        foreach ($problem_ids as $problem_id) {
            ProblemResult::factory()
                ->create([
                    'problem_id' => $problem_id,
                ]);
        }
    }
}
