<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function todo()
    {
        // 1 2 3
        // executar /tasks
        $this->withExceptionHandling();
        $response = $this->get('/tasks');
//        dd ($response->getContent());
        $response->assertSuccessful();
        $response->assertSee('Tasques');
//        $this->get('/tasks');
    }
}
