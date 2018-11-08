<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class TagTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function map()
    {
        //1

        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false,
            'user_id' => $user->id
        ]);

        //2

        $mappedTask = $task->map();
        // 3
        $this->assertEquals($mappedTask['id'],1);
        $this->assertEquals($mappedTask['name'],'Comprar pa');
        $this->assertEquals($mappedTask['completed'],false);
        $this->assertEquals($mappedTask['user_id'],$user->id);
        $this->assertEquals($mappedTask['user_name'],$user->name);
        $this->assertEquals($mappedTask['user_email'],$user->email);
        $this->assertTrue($user->is($mappedTask['user']));
//        $this->assertEquals($task->name,$newTask['name']);
//        $this->assertEquals($newTask->completed,$task['completed']);

    }
}