<?php

namespace App\Jobs;

use App\Mail\TaskDeletedMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TaskDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $task;
    protected $admin;
    protected $message;
    public function __construct(Task $task, User $admin,$message)
    {
        
        $this->task = $task;
        $this->admin = $admin;
        $this->message =$message;
      
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        dd('hi');
        Mail::to($this->admin->email)->send(new TaskDeletedMail($this->task, $this->message));
    }
}
