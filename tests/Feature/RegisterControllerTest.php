<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_register_a_user()
    {
        initialize_roles();
        $this->assertNull(Auth::user());

        //2
        $response = $this->post('/register', $user = [
            'name' => 'Marc Mestre',
            'email' => 'provaregister@gmail.com',
            'password' => 'secret222',
            'password_confirmation' => 'secret222'
        ]);

        //3
//        $this->assertDatabaseHas('users',['email' => 'provaregister@gmail.com']);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());

        $this->assertEquals($user['email'],Auth::user()->email);
        $this->assertEquals($user['name'],Auth::user()->name);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));

        $this->assertTrue(Auth::User()->hasRole('Tasks'));

    }

    /**
     * @test
     */
    public function cannot_register_a_user_with_invalid_data()
    {
        $response = $this->post('/register',[
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => ''
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/');


    }
}