<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 23/10/18
 * Time: 11:04
 */

namespace Tests\Unit;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class UserTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test
     */
    public function can_add_task_to_user()
    {
        // 1
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $user->addTask($task);
        //2
        $tasks = $user->tasks;
        // 3
        $this->assertTrue($tasks[0]->is($task));
    }
    /**
     * @test
     */
    public function user_can_have_tasks()
    {
        // 1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $user->addTask($task1);
        $user->addTask($task2);
        $user->addTask($task3);
        //2
        $tasks = $user->tasks;
        // 3
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }
    /**
     * @test
     */
    public function user_tasks_return_null_when_no_tasks()
    {
        // 1
        $user = factory(User::class)->create();
        //2
        $tasks = $user->tasks;
        // 3
        $this->assertEmpty($tasks);
    }

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        // 1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $tasks = [];
        array_push($tasks,$task1);
        array_push($tasks,$task2);
        array_push($tasks,$task3);

        //2
        $user->addTasks($tasks);

        // 3
        $tasks = $user->tasks;
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function haveTask()
    {
        $this->markTestSkipped();
        //2
        $user->haveTask();
    }

    /**
     * @test
     */
    public function removeTask()
    {
        $this->markTestSkipped();
        //2
        $user->removeTask();
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isSuperAdmin());
        $user->admin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin());

    }

    /**
     * @test
     */
    public function map()
    {
        $user = factory(User::class)->create([
           'name' => 'Pepe Pardo Jeans',
           'email' => 'pepepardo@jeans.com',
//           Accessors i mutators
        ]);

        $mappedUser = $user->map();

        $this->assertEquals($mappedUser['id'],1);
        $this->assertEquals($mappedUser['name'],'Pepe Pardo Jeans');
        $this->assertEquals($mappedUser['email'],'pepepardo@jeans.com');
        $this->assertEquals($mappedUser['avatar'],'https://www.gravatar.com/avatar/6849ef9c40c2540dc23ad9699a79a2f8');
    }

    /**
     * @test
     */
    public function regulars()
    {
        $this->assertCount(0,User::regular()->get());
        $user1 = factory(User::class)->create([
            'name' => 'Jakito Mestre Algueró',
            'email' => 'jaki@hotmail.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa la cerda',
            'email' => 'pepacerda@hotmail.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@hotmail.com'
        ]);
        $user3->admin = true;
        $user3->save();
        $this->assertCount(2,$regularusers=User::regular()->get());
        $this->assertEquals($regularusers[0]->name,'Jakito Mestre Algueró');
        $this->assertEquals($regularusers[1]->name,'Pepa la cerda');
    }
}