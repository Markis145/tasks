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
        //preparar
        $tag = factory(Tag::class)->create();
        $tag=Tag::create([
            'name'=>'Comprar pa',
            'description'=>'Comprar pa',
            'color'=>'blau'
        ]);
        //executar
        $mappedTask = $tag->map();
        $this->assertEquals($mappedTask['id'],$tag->id);
        $this->assertEquals($mappedTask['name'],$tag->name);
        $this->assertEquals($mappedTask['description'],$tag->description);
        $this->assertEquals($mappedTask['color'],$tag->color);
    }

    /**
     * @test
     */
    public function can_add_a_task_to_tag()
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
        $task2 = Task::create([
            'name' => 'Comprar llet'
        ]);
        // execució
        $tag->addTask($task);
        // Assertion
        $tasks = $tag->tasks;
        $this->assertTrue($tasks[0]->is($task));

        // execució
        $tag->addTask($task2->id);
        // Assertion
//        $tasks = $tag->tasks;
//        $this->assertTrue($tasks[1]->is($task2));
    }
}