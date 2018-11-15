<?php
namespace Tests\Feature;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $this->login();
        //1
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false,
            'description' => 'ba bla bla'
        ]);
        //2
        $response = $this->post('/completed_task/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $response->assertRedirect('/tasks');
        $this->assertEquals((boolean)$task->completed, true);
    }
    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->login();
        $response = $this->post('/completed_task/898080880');
        //3 Assert
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        $this->login();
        //1
        $task = Task::create([
            'name' => 'comprar pa',
            'completed' => true,
            'description' => 'ba bla bla'
        ]);
        //2
        $response = $this->delete('/completed_task/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $response->assertRedirect('/tasks');
        $this->assertEquals((boolean)$task->completed, false);
    }
    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        // 1 -> no cal fer res
        $this->login();
        // 2 Execute
        $response= $this->delete('/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }
}