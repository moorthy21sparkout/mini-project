<?php

namespace App\Console\Commands;

use App\Mail\TaskRemainingMail;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRemainMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail for all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    // public function handle()
    // {
    //     $tasks = Task::where('datetime_field', '<=', Carbon::now()->addHour())
    //         ->get();

    //     foreach ($tasks as $task) {
    //         $user = $task->user; // Fetch user associated with the task
    //         $email = $user->email;
    //         $userName = $user->name; // Fetch user's name

    //         // Additional task details
    //         $taskName = $task->name; // Fetch task name or other details as needed

    //         // Send email using Mailable
    //         Mail::to($email)->send(new TaskRemainingMail($task, $taskName, $userName));
    //     }

    //     // Output to console for verification
    //     $this->info('Reminder emails sent for tasks.');

    //     return 0; // Return 0 to indicate success
    // }
    public function handle()
    {
        // Fetch all tasks
        $tasks = Task::all();

        // Example: Send emails using Laravel Mail facade
        foreach ($tasks as $task) {
            $email = $task->user->email; // Assuming task has a user relationship
            Mail::to($email)->send(new TaskRemainingMail($task));
        }

        // Output to console for verification
        $this->info('Reminder emails sent for all tasks.');

        return 0; // Return 0 to indicate success
    }
}
