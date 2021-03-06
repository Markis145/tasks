<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RegisterAltControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_register_a_user()
    {
        $this->withoutExceptionHandling();

        $this->assertNull(Auth::user());
        //2
        $response = $this->post('/register_alt', $user = [
            'name' => 'Marc Mestre',
            'email' => 'provaregisterrrrrr@gmail.com',
            'password' => 'secret222',
            'password_confirmation' => 'secret222'
        ]);

        //3
//        $this->assertDatabaseHas('users',['email' => 'provaregisterrrrrr@gmail.com']);
        $this->assertNotNull(Auth::user());
        $response->assertStatus(302);
        $response->assertRedirect('/home');


        $this->assertEquals($user['email'],Auth::user()->email);
        $this->assertEquals($user['name'],Auth::user()->name);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));

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