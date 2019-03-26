<?php


use App\Listeners\SendTaskStoreNotification;
use App\Notifications\TaskStore;
use App\Events\TaskStore as TaskStoreEvent;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendTaskStoreNotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_task_store_notification()
    {

        $listener = new SendTaskStoreNotification();
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $task->assignUser($user);
//        $task = Task::create();
        $event = new TaskStore($task);
        Notification::fake();

        $listener->handle($event);
        Notification::assertSentTo(
            $user,
            TaskStoreEvent::class,
            function ($notification, $channels) use ($task) {
                return $notification->order->id === $task->id;
            }
        );
    }
}