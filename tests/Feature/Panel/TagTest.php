<?php

namespace Tests\Feature\Panel;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase , WithFaker;

    public function test_normal_user_can_not_see_tags_index()
    {
        $this->get(route('panel.tags.index'))->assertRedirect();
    }

    public function test_auth_user_can_see_tags_index()
    {
        $this->actingAsUser();
        $this->get(route('panel.tags.index'))->assertOk();
    }

    public function test_normal_user_can_not_create_tag()
    {
        $this->post(route('panel.tags.store') , $this->getTagData());
        $this->assertEquals(0 , Tag::count());
    }

    public function test_auth_user_can_create_tag()
    {
        $this->actingAsUser();
        $tag =  $this->post(route('panel.tags.store') , $this->getTagData());
        $this->assertEquals(1 , Tag::count());
    }

    public function test_normal_user_can_not_update_tag()
    {
        $newName = '::php::' ;
        $tag =  $this->createTag();
        $this->patch(route('panel.tags.update' , $tag->id ) , [
            'name' => $newName,
        ]);
        $this->assertEquals('::laravel::' , Tag::whereId($tag->id)->first()->name);
    }

    public function test_auth_user_can_update_tag()
    {
        $newName = '::php::' ;
        $this->actingAsUser();
        $tag = $this->createTag();
        $this->patch(route('panel.tags.update' , $tag->id ) , [
            'name' => $newName,
        ]);
        $this->assertDatabaseHas('tags' , [ 'id' => $tag->id , 'name' => $newName ]);
    }

    public function test_normal_user_can_not_delete_tag()
    {
        Tag::create($this->getTagData());
        $this->delete(route('panel.tags.destroy' , 1 ));
        $this->assertEquals(1 , Tag::count());
    }

    public function test_auth_user_can_delete_tag()
    {
        $this->actingAsUser();
        $tag = $this->createTag();
        $this->delete(route('panel.tags.destroy' , $tag->id ));
        $this->assertEquals(0 , Tag::count());
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
        return  $this->actingAs($user);
    }

    private function createTag()
    {
        return  Tag::create($this->getTagData());
    }

    private function getTagData(): array
    {
        return [
            'name' => '::laravel::',
        ];
    }
}
