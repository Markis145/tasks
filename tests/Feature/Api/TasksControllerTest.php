<?php
namespace Tests\Feature\Api;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    // CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    // BREAD -> PA -> BROWSE READ EDIT ADD DELETE

    /**
     * @test
     */
    public function superadmin_can_show_a_task()
    {
        $user = $this->login('api');
        $user->admin = true;
        $user->save();
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');
        // TODO add role Taskmanager al usuari
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_task()
    {
        $this->login('api');
        //1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }
    /**
     * @test
     */
    public function task_manager_can_delete_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');
        // 1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->delete('/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function superadmin_can_delete_task()
    {
        $user = $this->login('api');
        $user->admin = true;
        $user->save();
        // 1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->delete('/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNull(Task::find($task->id));
    }
    /**
     * @test
     */
    public function regular_user_cannot_delete_task()
    {
        $this->login('api');
        // 1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->delete('/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_create_tasks_without_a_name()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => ''
        ]);
        $result = json_decode($response->getContent());
        $response->assertStatus(422);

    }
    /**
     * @test
     */
    public function cannot_edit_task_without_name()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');
        // 1
        $oldTask = factory(Task::class)->create();
        // 2
        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);
        // 3
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function task_manager_can_create_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');

        //$user->givePermissionTo('task.store');

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_create_task()
    {
        $this->login('api');

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);
        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_create_task()
    {
        $user = $this->login('api');
        $user->admin = true;
        $user->save();

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_tasks()
    {
        $this->login('api');
        //1
        create_example_tasks();
        $response = $this->json('GET', '/api/v1/tasks/', [
            'name' => 'comprar pa'
        ]);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3, $result);
        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);
        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean)$result[1]->completed);
        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean)$result[2]->completed);
    }

    /**
     * @test
     */
    public function task_manager_can_edit_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TaskManager');
        // 1
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'ba bla bla'
        ]);
        // 2
        $response = $this->put('/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'ba bla bla'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function superadmin_can_edit_task()
    {
        $user = $this->login('api');
        $user->admin = true;
        $user->save();
        // 1
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'ba bla bla'
        ]);
        // 2
        $response = $this->put('/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'ba bla bla'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function regular_user_can_edit_task()
    {
        $this->login('api');
        // 1
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'ba bla bla'
        ]);
        // 2
        $response = $this->put('/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'ba bla bla'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }
}