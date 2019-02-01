<?php

namespace App\Listeners;

use App\Mail\TaskStore;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendMailTaskStore implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $subject = $event->task->subject();
        Mail::to($event->user)
            ->cc(config('tasks.manager_email'))
            ->send(new TaskStore($event->task));
    }
}
