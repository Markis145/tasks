<?php

namespace Tests\Unit;
use App\File;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_can_have_tags() {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $tag1 = Tag::create([
            'name' => 'home'
        ]);
        $tag2 = Tag::create([
            'name' => 'work'
        ]);
        $tag3 = Tag::create([
            'name' => 'studies'
        ]);
        $tags = [$tag1, $tag2, $tag3];
        // execució
        $task->assignTags($tags);
        // Assertion
        $tags = $task->tags();
        $this->assertTrue($tags[0]->is($tag1));
        $this->assertTrue($tags[1]->is($tag2));
        $this->assertTrue($tags[2]->is($tag3));
    }

    /**
     * @test
     */
    public function a_task_can_have_one_file()
    {
//        1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $fileOriginal = File::create([
            'path' => 'fitxer1.pdf'
        ]);
//        add_file_to_task($file,$task);
        $task->assignFile($fileOriginal);

//        2 Execute -> Wishful programming
        // Important 2 maneres
        // 1 Això torna tota la relació, treball extra
//        $file = $task->file();
        // 2 això retorna el objecte
        $file = $task->file;

//        3 Comprovo
        // $file
        $this->assertTrue($file->is($fileOriginal));
    }

    /**
     * @test
     */
    public function a_task_file_returns_null_when_no_file_is_assigned()
    {
//        1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

//        2 Execute -> Wishful programming
        $file = $task->file();

//        3 Comprovo
        $this->assertNull($file);
    }


}