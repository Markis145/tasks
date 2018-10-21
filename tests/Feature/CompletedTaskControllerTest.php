<?php
namespace Tests\Feature;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_complete_a_task()
    {
        //1
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2
        $response = $this->put('/tasks-completed/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $response->assertRedirect('/tasks');
        $this->assertEquals($task->completed, true);
    }
    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->withoutExceptionHandling();
        $response = $this->put('/tasks-completed/1');
        //3 Assert
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        //1
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        $response = $this->put('/tasks-completed/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $response->assertRedirect('/tasks');
        $this->assertEquals($task->completed,1);
    }
    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        $this->withoutExceptionHandling();
        // 1 -> no cal fer res
        // 2 Execute
        $response= $this->put('/tasks-completed/1');
        //3 Assert
        $response->assertStatus(404);
    }
}