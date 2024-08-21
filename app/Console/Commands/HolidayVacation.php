<?php

namespace App\Console\Commands;

use App\Models\Holiday;
use Illuminate\Console\Command;

class HolidayVacation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:holiday-vacation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Fixed-date holidays for the upcoming year.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentYear = date('Y') + 1; // For the upcoming year
        $fixedHolidays = [
            'New Year\'s Day' => "$currentYear-01-01",
            'Proclamation of Independence' => "$currentYear-01-11",
            'Amazigh New Year' => "$currentYear-01-14",
            'Labor Day' => "$currentYear-05-01",
            'National Day' => "$currentYear-07-14",
            'Enthoronement' => "$currentYear-07-30",
            'Aid Al Massira' => "$currentYear-08-20",
            'Zikra Oued Ed-Dahab' => "$currentYear-08-14",
            'Youth Day' => "$currentYear-08-21",
            'Revolution of the King and the People' => "$currentYear-08-21",
            'Green March' => "$currentYear-11-06",
            'Christmas' => "$currentYear-12-25",
        ];

        foreach ($fixedHolidays as $name => $date) {
            Holiday::query()->create([
                'name' => $name,
                'date' => $date,
                'status' => 'national',
                'days_number' => 1,
            ]);
        }

        $this->info(
            'Fixed-date holidays have been created for the upcoming year. ' .
                $currentYear
        );

        $this->info(
            'Fixed-date holidays have been created for the upcoming year.'
        );
    }
}
