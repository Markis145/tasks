<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 11/10/18
 * Time: 19:24
 */

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    // CRUD -> CREATE RETRIEVE UPDATE DELETE
    //BREAD -> BROWSE READ EDIT ADD DELETE
    /**
     * @test
     */
    public function can_show_a_tasks()
    {
        $this->withoutExceptionHandling();
        // routes/api.php
        // http://tasks.test/api/v1/tasks
//        HTTP -> GET/POST/PUT/DELETE

        // 1 PREPARE
//        Task:create()

        $task = factory(Task::class)->create([
            'name' => 'Comprar pa'
        ]);

        // 2
        $response = $this->get('/api/v1/tasks/' . $task->id);


        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->withoutExceptionHandling();
        //1
        $task = factory(Task::class)->create();

        //2
        $response = $this->delete('/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);

//        $this->assertDatabaseMissing('tasks',$task);
        $this->assertNull(Task::find($task->id));
    }
    /**
     * @test
     */
    public function can_create_task()
    {
        $this->withoutExceptionHandling();

        //2
        $response = $this->post('/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertEquals('', $result);

//        $this->assertDatabaseMissing('tasks',$task);
        $this->assertNotNull(Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_task()
    {
        $this->withoutExceptionHandling();
        create_example_tasks();
        $response = $this->get('/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);
        $this->assertEquals('comprar pa',$result[0]->name);
        $this->assertFalse((boolean) $result->completed);

    }

    public function can_edit_task()
    {
        $this->withoutExceptionHandling();
        //1
        $task = factory(Task::class)->create([
            'name' => 'Comprar pa'
        ]);

        //2
        $response = $this->put('/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);

//        $this->assertDatabaseMissing('tasks',$task);
        $this->assertNull(Task::find($task->id));
    }
}