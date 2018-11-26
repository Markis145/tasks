<?php
namespace Tests\Feature;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksVueControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
//        $this->withoutExceptionHandling();
        create_example_tasks();
        $this->login();
        // Prepare

        // Execute
        $response = $this->get('/tasks_vue');
        // Assert
        $response->assertSuccessful();
        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks',Task::all());
    }
}