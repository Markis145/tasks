<?php

use App\Log;
use App\Mail\TaskDelete;
use App\Mail\TaskStore;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMailTaskDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_stored_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        // Executar
//        event(new TaskUncompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskDelete();
        $listener->handle(new \App\Events\TaskDelete($task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskDelete::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }
}