<?php

namespace Database\Seeders;

use App\Models\LeaveStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveStatus::factory(3)->create();
    }
}
