<?php

use App\Log;
use App\Mail\TaskUncompleted;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskModifyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_modify_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        $task_old = $task;
        // Executar
//        event(new TaskUncompleted($task));

        $listener = new \App\Listeners\LogTaskModify();
        $listener->handle(new \App\Events\TaskModify($task_old,$task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha modificat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'update');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,$task_old);
        $this->assertEquals($log->new_value,$task);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'autorenew');
        $this->assertEquals($log->color,'primary');
    }
}