<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class TaskTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test
     */
    public function can_assign_user_to_task()
    {
        // 1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $userOriginal = factory(User::class)->create();
        // 2
        $task->assignUser($userOriginal);
        // 3
        $user = $task->user;
        $this->assertTrue($user->is($userOriginal));
    }
    /**
     * @test
     */
    public function a_task_can_have_one_file()
    {
        //1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $fileOriginal = File::create([
            'path' => 'fitxer1.pdf'
        ]);
        $task->assignFile($fileOriginal);
        //2
        // IMPORTANT 2 maneres
        //Torna tota la relació, treball extra
//        $file = $task->file()->where('path','');
        //Això retorna el objecte
        $file = $task->file;
        //3
        $this->assertTrue($file->is($fileOriginal));
    }
    /**
     * @test
     */
    public function a_task_can_have_tags()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $tag1 = Tag::create([
            'name' => 'feina',
            'description' => "blablab",
            'color' => '#04B404'
        ]);
        $tag2 = Tag::create([
            'name' => 'classe',
            'description' => "blablab",
            'color' => '#04B404'
        ]);
        $tag3 = Tag::create([
            'name' => 'casa',
            'description' => "blablab",
            'color' => '#04B404'
        ]);
        $tags = [$tag1, $tag2, $tag3];
        // execució
        $task->addTags($tags);
        // Assertion
        $tags = $task->tags;
        $this->assertTrue($tags[0]->is($tag1));
        $this->assertTrue($tags[1]->is($tag2));
        $this->assertTrue($tags[2]->is($tag3));
    }
    /**
     * @test
     */
    public function a_assign_tag_to_task()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $tag = Tag::create([
            'name' => 'feina',
            'description' => "blablab",
            'color' => '#04B404'
        ]);
        // execució
        $task->addTag($tag);
        // Assertion
        $tags = $task->tags;
        $this->assertTrue($tags[0]->is($tag));
    }
    /**
     * @test
     */
    public function a_task_file_returns_null_when_no_file_is_assigned()
    {
        //1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        //2
        $file = $task->file;
        //3
        $this->assertNull($file);
    }

    /**
     * @test
     */
    public function can_toggle_completed()
    {
        $task = factory(Task::class)->create([
            'completed'=>false
        ]);
        $task->toggleCompleted();
        $this->assertTrue($task->completed);

        $task = factory(Task::class)->create([
            'completed'=>true
        ]);
        $task->toggleCompleted();
        $this->assertFalse($task->completed);
    }

    /**
     * @test
     */
    public function map()
    {
        //1
        $user = factory(User::class)->create();

//        $user = User::create([
//            'name' => 'marc',
//            'email' => 'marcmestre@iesebre.com',
//            'password' => 'memes'
//        ]);

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