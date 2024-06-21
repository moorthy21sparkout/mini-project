<?php

namespace App\Listeners;

use App\Events\UserTaskCreatedEvent;
use App\Models\User;
use App\Notifications\UserTaskCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserTaskCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserTaskCreatedEvent  $event
     * @return void
     */
    public function handle(UserTaskCreatedEvent $event)
    {
        $admin = User::where('usertype', 'admin')->first();

        if ($admin) {
            $admin->notify(new UserTaskCreateNotification());
        }
    }
}
