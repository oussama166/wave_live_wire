<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSalaryChange implements ShouldQueue
{

    /**
     * Create a new job instance.
     */
    public function __construct(private $id,private $amount,private $admin)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // we need to find the user

        // add the schedule date
        // update the amount of salary information
        // notify the user and the admin with that information

    }
}
