<?php

namespace Database\Seeders;

use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(FamilyStatusSeeder::class);
        $this->call(LeaveStatusSeeder::class);
        $this->call(VacationTypeSeeder::class);
        $this->call(ContractsSeeder::class);
        $this->call(ExperienceLevelsSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(LeavesSeeder::class);
    }
}
