<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Sector::truncate();
        Sector::insert([
            [
                'name' => 'BFSI',
                'icon' => 'hospital',
            ],
            [
                'name' => 'Logistick, E-Commerce and Supply chain',
                'icon' => 'car-front-fill',
            ],
            [
                'name' => 'Information Technology',
                'icon' => 'pc-display',
            ],
            [
                'name' => 'Hospitality and Hotel Management',
                'icon' => 'bell-fill',
            ],
        ]);

        Question::truncate();
        Question::factory(20)->create();
    }
}
