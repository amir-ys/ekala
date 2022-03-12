<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.brands.index'));

        $response->assertOk()
            ->assertViewIs('panel.brands.index')
            ->assertViewHas('brands' , Brand::latest()->paginate());
    }

    public function test_edit_method()
    {
        $brand = Brand::factory()->create();
        $this->actingAsUser();
        $response = $this->get(route('panel.brands.edit' , $brand->id));

        $response->assertOk()
            ->assertViewIs('panel.brands.edit')
            ->assertViewHas('brand' , $brand);
    }

    public function test_store_brand()
    {
        $this->actingAsUser();
        $data = Brand::factory()->make()->toArray();

        $response = $this->post(route('panel.brands.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'brands',1 );
        $this->assertDatabaseHas( 'brands', $data );
    }

    public function test_update_brand()
    {
        $this->actingAsUser();
        $brand = Brand::factory()->create();
        $data = Brand::factory()->make()->toArray();

        $response = $this->patch(route('panel.brands.update' , $brand->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'brands',1 );
        $this->assertDatabaseHas( 'brands', $data );
    }

    public function test_destroy_brand()
    {
        $this->actingAsUser();
        $brand = Brand::factory()->create();

        $response = $this->delete(route('panel.brands.destroy' , $brand->id));

        $response->assertJson(['message' => 'برند ' . $brand->name.' با موفقیت حذف شد.']);
        $this->assertDatabaseCount('brands' , 0);
        $this->assertDatabaseMissing('brands' , $brand->toArray());

    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
