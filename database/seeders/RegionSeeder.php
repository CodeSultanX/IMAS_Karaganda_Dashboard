<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['title' => 'Нуринский район'],
            ['title' => 'Осакаровский район'],
            ['title' => 'Каркаралинский район'],
            ['title' => 'Актогайский район'],
            ['title' => 'Абайский район'],
            ['title' => 'Бухар-Жырауский район'],
            ['title' => 'город Темиртау'],
            ['title' => 'город Караганда'],
            ['title' => 'город Сарань'],
            ['title' => 'город Шахтинск'],
            ['title' => 'город Балхаш'],
        ];

        DB::table('regions')->insert($regions);
    }
}
