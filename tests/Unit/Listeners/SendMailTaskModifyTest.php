<?php

use App\Log;
use App\Mail\TaskModify;
use App\Mail\TaskStore;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMailTaskStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_stored_mail_has_been_send()
    {
        $this->withoutExceptionHandling();
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        $task_old = $task;
        // Executar
//        event(new TaskUncompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskModify();
        $listener->handle(new \App\Events\TaskModify($task_old,$task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskModify::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }
}