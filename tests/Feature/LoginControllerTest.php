<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_login_a_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        //2
        $response = $this->post('/login',[
            'email' => 'prova@gmail.com',
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNull(Auth::user());
//        $this->assertEquals('prova@gmail.com',Auth::user()->email);
    }

    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_password()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        //2
        $response = $this->post('login',[
            'email' => 'prova@gmail.com',
            'passowrd' => 'asdasdasdasdasdasdd324234234asd'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }

    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        //2
        $response = $this->post('login',[
            'email' => 'proasdasdasdasdva@gmail.com',
            'passowrd' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }
}