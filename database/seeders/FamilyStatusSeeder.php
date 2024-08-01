<?php

namespace Database\Seeders;

use App\Models\FamilyStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FamilyStatus::factory(4)->create();
    }
}
