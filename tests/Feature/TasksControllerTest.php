<?php
// PSR-4
namespace Tests\Feature;
use App\Task;
use App\User;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_show_tasks()
    {
        //1 Prepare
        create_example_tasks();

        $this->login();

        // 2 execute
        $response = $this->get('/tasks');

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');
        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');
    }
    /**
     * @test
     */
    public function can_store_task()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $response = $this->post('/tasks',[
            'name' => 'Comprar llet'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks',['name' => 'Comprar llet']);
    }
    /**
     * @test
     */
    public function cannot_delete_an_unexisting_task()
    {
        $this->login();
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->login();

        // 1
        $task = Task::create([
            'name' => 'Comprar llet'
        ]);
        // 2
        $response = $this->delete('/tasks/' . $task->id);
        // 3
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'Comprar llet']);
    }
    /**
     * @test
     */
    public function can_edit_a_task()
    {
        $this->login();
        // 1
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => '0'
        ]);
        //2
        $response = $this->put('/tasks/' . $task->id,$newTask = [
            'name' => 'Comprar pa',
            'completed' => '1'
        ]);
        $response->assertStatus(302);
        $task = $task->fresh();
        $this->assertEquals($task->name,$newTask['name']);
        $this->assertEquals($task->completed,$newTask['completed']);
    }
    /**
     * @test
     */
    public function can_edit_a_task_todo_validation()
    {
        $this->markTestSkipped();
        $this->withoutExceptionHandling();
        // 1
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => false
        ]);
        //2
        $response = $this->put('/tasks/' . $task->id,$newTask = [
            'completed' => true
        ]);
        $response->assertSuccessful();
//            $response->assertStatus(200);
        // 2 opcions
//        $this->assertDatabaseHas('tasks',$newTask);
//        $this->assertDatabaseMissing('tasks',$task);
        $task = $task->fresh();
        $this->assertEquals($task->name,'Comprar pa');
        $this->assertEquals($task->completed,true);
    }
    /**
     * @test
     */
    public function cannot_edit_an_unexisting_task()
    {
        $this->login();
        // 2 execute HTTP REQUEST -> HTTP RESPONSE (resposta)
        $response = $this->put('/tasks/1',[]);
//        dd($response->getContent());
        // 3 assert
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_show_edit_form()
    {
        // 1
        $this->login();
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        $response = $this->get('/task_edit/' . $task->id);
        $response->assertSuccessful();
        $response->assertSee('Comprar pa');
    }
    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
        $this->login();
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }

}