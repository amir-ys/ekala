<?php

namespace Tests\Feature\Brand;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase , WithFaker;

    public function test_normal_user_can_not_see_bands_index()
    {
        $this->get(route('panel.brands.index'))->assertStatus(302);
    }

    public function test_auth_user_can_see_bands_index()
    {
        $this->actingAsUser();
        $this->get(route('panel.brands.index'))->assertStatus(200);
    }

    public function test_normal_user_can_not_create_brand()
    {
        $this->post(route('panel.brands.store') , $this->getBrandData());
       $this->assertEquals(0 , Brand::count());
    }

    public function test_auth_user_can_create_brand()
    {
        $this->actingAsUser();
        $this->post(route('panel.brands.store') , $this->getBrandData());
        $this->assertEquals(1 , Brand::count());
    }

    public function test_normal_user_can_not_update_brand()
    {
        $newName = 'google' ;
        $brand =  $this->createBrand();
         $this->patch(route('panel.brands.update' , $brand->id ) , [
            'name' => $newName,
            'status' => Brand::STATUS_ACTIVE
        ]);
        $this->assertEquals('::apple::' , Brand::whereId($brand->id)->first()->name);
    }

    public function test_auth_user_can_update_brand()
    {
        $newName = 'google' ;
        $this->actingAsUser();
        $brand = $this->createBrand();
        $this->patch(route('panel.brands.update' , $brand->id ) , [
            'name' => $newName,
            'status' => Brand::STATUS_ACTIVE
        ]);
        $this->assertEquals('google' , Brand::whereId($brand->id)->first()->name);
    }

    public function test_normal_user_can_not_delete_brand()
    {
        Brand::create($this->getBrandData());
        $this->delete(route('panel.brands.destroy' , 1 ));
        $this->assertEquals(1 , Brand::count());
    }

    public function test_auth_user_can_delete_brand()
    {
        $this->actingAsUser();
        $brand = $this->createBrand();
        $this->delete(route('panel.brands.destroy' , $brand->id ));
        $this->assertEquals(0 , Brand::count());
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
      return  $this->actingAs($user);
    }

    private function createBrand()
    {
       return  Brand::create($this->getBrandData());
    }

    private function getBrandData(): array
    {
        return [
            'name' => '::apple::',
            'status' => Brand::STATUS_ACTIVE
        ];
    }


}
