<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('holidays')->insert([
            [
                'name' => 'Aid Al Massira',
                'date' => '2024-08-20',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'New Year\'s Day',
                'date' => '2024-01-01',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Proclamation of Independence',
                'date' => '2024-01-11',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Amazigh New Year',
                'date' => '2024-01-14',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Labour Day',
                'date' => '2024-05-01',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Enthronement',
                'date' => '2024-07-30',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Zikra Oued Ed-Dahab',
                'date' => '2024-08-14',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Revolution of the King and the People',
                'date' => '2024-08-20',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Youth Day',
                'date' => '2024-08-21',
                'days_number' => 1,
                'status' => 'national',
            ],
            [
                'name' => 'Green March',
                'date' => '2024-11-06',
                'days_number' => 1,
                'status' => 'national',
            ],
        ]);
    }
}
