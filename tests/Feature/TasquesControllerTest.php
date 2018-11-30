<?php
namespace Tests\Feature;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasquesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    // 1) Superadmin
    // 2)TaskManager
    // 3)Rol tasks
    // 4)Regular user
    // 5)Guest_user

    /**
     * @test
     */
    public function superadmin_can_index_tasks()
    {
        create_example_tasks();
        $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();

        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function guest_user_cannot_index_tasks()
    {
        $response = $this->get('/tasques');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tasks()
    {
        $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function task_manager_can_index_tasks()
    {
        create_example_tasks();
        $this->loginAsTaskManager();
        $response = $this->get('/tasques');
        $response->assertSuccessful();

        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function tasks_user_can_index_tasks()
    {
        create_example_tasks();
        $user = $this->loginAsTasksUser();
        Task::create([
            'name' => 'Tasca usuari logat',
            'completed' => false,
            'description' => 'Jorl',
            'user_id' => $user->id
        ]);
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===1 &&
                $tasks[0]['name']==='Tasca usuari logat';
        });
        $response->assertViewHas('users');
        $response->assertViewHas('uri');
    }

}