<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class ClockControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;
    /**
     * @test
     */
    public function can_login_a_user()
    {
        $this->login();

        $response = $this->get('/clock');

        $response->assertSuccessful();
        $response->assertViewIs('clock.index');
    }

}