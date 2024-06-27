<?php

namespace App\Observers;

use App\Jobs\TaskCreated;
use App\Jobs\TaskDeleted;
use App\Jobs\TaskUpdated;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $admin = User::where('usertype', 'admin')->first();
        $user = User::where('usertype', 'user')->first();

        $message = 'Task "' . $task->task . '" is created by ' . $task->user->name;

        if ($admin) {
            dispatch(new TaskCreated($task, $admin, $message));
        }

        if ($user) {
            dispatch(new TaskCreated($task, $user, $message));
        }
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $admin = User::where('usertype', 'admin')->first();
        $message = 'Task "' . $task->task . '" is updated by ' . $task->user->name;

        if ($admin) {
            dispatch(new TaskUpdated($task, $admin, $message));
        }
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleting(Task $task)
    {
        $admin = User::where('usertype', 'admin')->first();
        $message = 'Task "' . $task->task . '" is deleted by ' . $task->user->name;

        if ($admin) {
            dispatch(new TaskDeleted($task, $admin, $message));
        }
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
