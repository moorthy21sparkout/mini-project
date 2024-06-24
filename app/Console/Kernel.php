<?php

namespace App\Console;

use App\Jobs\RemainingTime;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Fetch tasks due within the next hour
            $tasksDueSoon = Task::whereBetween('due_date', [now(), now()->addHour()])
                ->whereNull('reminder_sent_at')
                ->get();

            foreach ($tasksDueSoon as $task) {
                    RemainingTime::dispatch($task);

                // Update task to mark reminder sent to avoid sending multiple reminders
                $task->update(['reminder_sent_at' => now()]);
            }
        })->everyMinute(); // Run this job hourly or adjust as per your requirement
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
