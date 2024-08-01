<?php

namespace Database\Seeders;

use App\Models\ExperienceLevels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExperienceLevels::factory(4)->create();
    }
}
