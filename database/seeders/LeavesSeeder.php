<?php

namespace Database\Seeders;

use App\Models\Leaves;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leaves::factory(100)->create();
    }
}
