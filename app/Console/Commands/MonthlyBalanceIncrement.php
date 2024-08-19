<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MonthlyBalanceIncrement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monthly-balance-increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all users
        $users = User::all();

        // Log the number of users being processed
        \Log::info('Number of users to process: ' . $users->count());

        // Loop through each user and increment their balance
        foreach ($users as $user) {
            $user->balance += 1.5;
            $user->save();
        }

        // Log that the balance increment process has started
        \Log::info('Monthly Balance Increment process completed successfully.');
    }

}
