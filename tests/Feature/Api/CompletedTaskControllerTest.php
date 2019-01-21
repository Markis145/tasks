<?php
namespace Tests\Feature\Api;
use App\Events\TaskCompleted;
use App\Events\TaskUncompleted;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_complete_a_task()
    {

        $user = $this->loginAsTaskManager('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        Event::fake();
        $response = $this->json('POST','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, true);
        Event::assertDispatched(TaskCompleted::class, function ($event) use ($task) {
            return $event->task->is($task);
        });
    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->loginAsTaskManager('api');
        $response = $this->json('POST','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
//        $this->withoutExceptionHandling();
        $user = $this->loginAsTaskManager('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        Event::fake();
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, false);
        Event::assertDispatched(TaskUncompleted::class, function ($event) use ($task) {
            return $event->task->is($task);
        });

    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        // 1 -> no cal fer res
        $this->loginAsTaskManager('api');
        // 2 Execute
        $response= $this->json('DELETE','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

}