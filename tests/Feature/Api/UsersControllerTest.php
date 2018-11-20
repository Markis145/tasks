<?php

namespace Tests\Feature\Api;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_list_users()
    {
        $user1 = factory(User::class)->create([
           'name' => 'Jakito Mestre Algueró',
           'email' => 'jaki@hotmail.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa la cerda',
            'email' => 'pepacerda@hotmail.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@hotmail.com'
        ]);
        $users = [$user1,$user2,$user3];
        $this->actingAs($user1,'api');
        $response = $this->json('GET','api/v1/users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());

        $this->assertEquals($result[0]->name,'Jakito Mestre Algueró');
        $this->assertEquals($result[0]->email,'jaki@hotmail.com');
        $this->assertEquals($result[0]->avatar,'https://www.gravatar.com/avatar/' . md5('jaki@hotmail.com'));
        $this->assertEquals($result[1]->name,'Pepa la cerda');
        $this->assertEquals($result[1]->email,'pepacerda@hotmail.com');
        $this->assertEquals($result[1]->avatar,'https://www.gravatar.com/avatar/' . md5('pepacerda@hotmail.com'));
        $this->assertEquals($result[2]->name,'Pepa Pig');
        $this->assertEquals($result[2]->email,'pepapig@hotmail.com');
        $this->assertEquals($result[2]->avatar,'https://www.gravatar.com/avatar/' . md5('pepapig@hotmail.com'));
    }
}