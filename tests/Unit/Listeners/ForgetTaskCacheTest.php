<?php

use App\Events\TaskStore;
use App\Listeners\ForgetTaskCache;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ForgetTaskCacheTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_forget_incidents_key()
    {
        $listener = new ForgetTaskCache();
        $task = Task::create([
            'name' => 'comprar pa'
        ]);

        $user = User::create([
           'name' => 'Marc Mestre',
            'email' => 'marcmestre@iesebre.com',
            'password' => "123456"
        ]);
        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASKS_CACHE_KEY);

        $listener->handle(new TaskStore($task,$user));

    }
}