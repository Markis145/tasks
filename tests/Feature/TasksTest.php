<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    /**
     * @test
     */
    public function todo()
    {
        // executar /tasks
        $this->withExceptionHandling();

        //1 prepare
        Task::create([
            'name' => 'comprar pa',
            'completed' => 'false'
        ]);

        // 2 execute
        $response = $this->get('/tasks');

        //3 comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        //comprovar que es veuen les tasques que hi ha a la base de dades
    }
}
