<?php

namespace Database\Seeders;

use App\Models\VacationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VacationType::factory(10)->create();
    }
}
