<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test
     */
    public function create_primary_user()
    {
        //2
        create_primary_user();

        $user = User::where('email','marcmestre@iesebre.com')->first();
        $this->assertEquals($user->name,'Marc Mestre Alguero');
        $this->assertEquals($user->email,'marcmestre@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', '123456'), $user->password));
    }
}
