<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Attribute;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.attributes.index'));

        $response->assertOk()
            ->assertViewIs('panel.attributes.index')
            ->assertViewHas('attributes' , Attribute::latest()->paginate());
    }

    public function test_edit_method()
    {
        $attribute = Attribute::factory()->create();
        $this->actingAsUser();
        $response = $this->get(route('panel.attributes.edit' , $attribute->id));

        $response->assertOk()
            ->assertViewIs('panel.attributes.edit')
            ->assertViewHas('attribute' , $attribute);
    }

    public function test_store_attribute()
    {
        $this->actingAsUser();
        $data = Attribute::factory()->make()->toArray();

        $response = $this->post(route('panel.attributes.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'attributes',1 );
        $this->assertDatabaseHas( 'attributes', $data );
    }

    public function test_update_attribute()
    {
        $this->actingAsUser();
        $attribute = Attribute::factory()->create();
        $data = Attribute::factory()->make()->toArray();

        $response = $this->patch(route('panel.attributes.update' , $attribute->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'attributes',1 );
        $this->assertDatabaseHas( 'attributes', $data );
    }

    public function test_destroy_attribute()
    {
        $this->actingAsUser();
        $attribute = Attribute::factory()->create();

        $response = $this->delete(route('panel.attributes.destroy' , $attribute->id));

        $response->assertJson(['message' => 'ویژگی ' . $attribute->name.' با موفقیت حذف شد.']);
        $this->assertDatabaseCount('attributes' , 0);
        $this->assertDatabaseMissing('attributes' , $attribute->toArray());

    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
