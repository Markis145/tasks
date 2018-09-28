<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function can_show_tasks()
    {
        // executar /tasks
        $this->withExceptionHandling();

        //1 prepare
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);
        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => false
        ]);

//        dd(Task::find(1));
        // 2 execute
        $response = $this->get('/tasks');

        //3 comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');
        //comprovar que es veuen les tasques que hi ha a la base de dades
    }

    /**
     * @test
     */
    public function can_store_task()
    {
        $this->withExceptionHandling();

        $response = $this->post('/tasks',[
            'name' => 'comprar llet'

        ]);

        $response->assertStatus(302);
        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks',['name' => 'comprar llet']);
    }


    /**
     * @test
     */
    public function cannot_delete_an_unexisting_task()
    {
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->withExceptionHandling();

        $task = Task::create([
            'name' => 'comprar llet'
        ]);
        //2
        $response = $this->delete('/tasks/' . $task->id);

        //3
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'comprar llet']);
    }

}
