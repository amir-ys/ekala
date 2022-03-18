<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
       $response =  $this->get(route('panel.tags.index'));

       $response->assertViewIs('panel.tags.index')
           ->assertViewHas('tags' , Tag::query()->latest()->paginate());
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $tag = Tag::factory()->create();
        $response =  $this->get(route('panel.tags.edit' , $tag->id ));

        $response->assertViewIs('panel.tags.edit')
            ->assertViewHas('tag' , $tag );
    }

    public function test_store_tag()
    {
        $this->actingAsUser();
        $data = Tag::factory()->make()->toArray();
        $response =  $this->post(route('panel.tags.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('tags' ,1);
        $this->assertDatabaseHas('tags' ,$data);
    }

    public function test_update_tag()
    {
        $this->actingAsUser();
        $oldTag = Tag::factory()->create();
        $data = Tag::factory()->make()->toArray();
        $response =  $this->patch(route('panel.tags.update' , $oldTag->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('tags' ,1);
        $this->assertDatabaseHas('tags' ,$data);
    }

    public function test_destroy_tag()
    {
        $this->actingAsUser();
        $tag = Tag::factory()->create();
        $response =  $this->delete(route('panel.tags.destroy' , $tag->id));

        $response->assertJson([
            'message' => 'برچسب ' .$tag->name. ' با موفقیت حذف شد.'
        ]);
        $this->assertDatabaseCount('tags' ,0);
        $this->assertDatabaseMissing('tags' ,$tag->toArray());
    }

    private function actingAsUser()
    {
        $this->actingAs(User::factory()->create());
    }

}
