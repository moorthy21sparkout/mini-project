<?php

namespace App\Console;

use App\Console\Commands\SendRemainMail;
use App\Jobs\RemainingTime;
use App\Mail\TaskRemainingMail;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands=[
      SendRemainMail::class,  
    ];     
    
    protected function schedule(Schedule $schedule)
    {
            $schedule->command('send:mail')->daily();
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
