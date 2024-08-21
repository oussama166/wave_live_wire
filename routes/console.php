<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote')
    ->hourly();

Schedule::command('app:monthly-balance-increment')->monthlyOn(1, '00:00');
Schedule::command('app:holiday-vacation')->yearlyOn(6, 1, '20:00');
