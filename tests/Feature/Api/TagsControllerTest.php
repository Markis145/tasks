<?php
namespace Tests\Feature\Api;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    // CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    // BREAD -> PA -> BROWSE READ EDIT ADD DELETE

    //FIELDS
    //name
    //description
    //color (string)
    /**
     * @test
     */
    public function can_show_a_tag()
    {
        $this->login('api');
        // 1
        $tag = factory(Tag::class)->create();
        // 2
        $response = $this->json('GET','/api/v1/tags/' . $tag->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($tag->name, $result->name);
    }
    /**
     * @test
     */
    public function can_delete_tag()
    {
        $this->login('api');
        // 1
        $tag = factory(Tag::class)->create();
        // 2
        $response = $this->delete('/api/v1/tags/' . $tag->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tags', $tag);
        $this->assertNull(Tag::find($tag->id));
    }

    /**
     * @test
     */
    public function cannot_create_tasks_without_a_name()
    {
        $this->login('api');
//        Petició HTTP normal, no és XHR (Ajax)
//        $response = $this->post('/api/v1/tags/',[
//            'name' => ''
//        ]);
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => ''
        ]);
        $result = json_decode($response->getContent());
        $response->assertStatus(422);

    }
    /**
     * @test
     */
    public function cannot_edit_tag_without_name()
    {
        $this->login('api');
        // 1
        $oldTag = factory(Tag::class)->create();
        // 2
        $response = $this->json('PUT', '/api/v1/tags/' . $oldTag->id, [
            'name' => ''
        ]);
        // 3
        $response->assertStatus(422);
    }
    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $response = $this->post('/api/v1/tags/',[
            'name' => 'feina',
            'description' => 'asdasdasd',
            'color' => '#04B404'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
//        $this->assertDatabaseHas('tags', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('feina',$result->name);
    }
    /**
     * @test
     */
    public function can_list_tagss()
    {
        $this->login('api');
        //1
        create_example_tags();
        $response = $this->json('GET', '/api/v1/tags/', [
            'name' => 'feina'
        ]);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3, $result);
        $this->assertEquals('feina', $result[0]->name);
        $this->assertEquals('blafeina', $result[0]->description);
        $this->assertEquals('classe', $result[1]->name);
        $this->assertEquals('blaclasse', $result[1]->description);
        $this->assertEquals('casa', $result[2]->name);
        $this->assertEquals('blacasa', $result[2]->description);
    }

    /**
     * @test
     */
    public function can_edit_tag()
    {
        $this->login('api');
        // 1
        $oldTag = factory(Tag::class)->create([
            'name' => 'feina'
        ]);
        // 2
        $response = $this->put('/api/v1/tags/' . $oldTag->id, [
            'name' => 'classe'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTag = $oldTag->refresh();
        $this->assertNotNull($newTag);
        $this->assertEquals('classe',$result->name);
        $this->assertFalse((boolean) $newTag->completed);
    }

}