<?php

use App\Log;
use App\Mail\TaskUncompleted;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_deleted_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));

        $listener = new \App\Listeners\LogTaskDelete();
        $listener->handle(new \App\Events\TaskDelete($task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha eliminat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'destroy');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,null);
        $this->assertEquals($log->new_value,$task);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'delete');
        $this->assertEquals($log->color,'primary');
    }
}