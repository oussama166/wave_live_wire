<?php

namespace Database\Seeders;

use App\Models\Contracts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contracts::factory(4)->create();
    }
}
