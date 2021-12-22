<?php

namespace Tests\Feature\Panel;

use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase ,WithFaker;

    public function test_normal_user_can_not_see_categories_index()
    {
        $this->get(route('panel.categories.index'))->assertStatus(302);
    }

    public function test_auth_user_can_see_categories_index()
    {
        $this->actingAsUser();
        $this->get(route('panel.categories.index'))->assertStatus(200);
    }

    public function test_normal_user_can_not_create_category()
    {
        $this->post(route('panel.categories.store') , $this->getCategoryRequestData());
        $this->assertEquals(0 , Category::count());
    }

    public function test_auth_user_can_create_category_with_attributes()
    {
        $this->actingAsUser();
        $this->post(route('panel.categories.store') , $this->getCategoryRequestData());
        $this->assertEquals(1 , Category::count());
        $this->assertEquals(1 , AttributeCategory::count());
    }

    public function test_normal_user_can_not_update_category()
    {
        $newName = '::sport::' ;
        $category =  $this->createCategory();
        $this->patch(route('panel.categories.update' , $category->id ) , [
            'name' => $newName,
            'status' => Category::STATUS_ACTIVE
        ]);
        $this->assertEquals('::digital::' , Category::whereId($category->id)->first()->name);
    }

    public function test_auth_user_can_update_category_with_attributes()
    {
        $attribute = Attribute::create(['name' => '::color::']);
        $newName = '::sport:::' ;
        $this->actingAsUser();
        $category = $this->createCategory();
        $this->patch(route('panel.categories.update' , $category->id ) , [
            'name' => $newName,
            'parent_id' => null,
            'slug' => 'table-slug',
            'status' => Category::STATUS_ACTIVE,
            'attribute_ids' =>  [$attribute->id] ,
            'attribute_filter_ids' =>  [$attribute->id]  ,
            'attribute_variation_id' => $attribute->id ,
        ]);
        $this->assertEquals($newName , Category::whereId($category->id)->first()->name);
        $this->assertEquals($attribute->name , AttributeCategory::where('attribute_id' ,$attribute->id)
                ->first()->attribute()->first()->name);
    }

    public function test_normal_user_can_not_delete_category()
    {
        Category::create($this->getCategoryData());
        $this->delete(route('panel.categories.destroy' , 1 ));
        $this->assertEquals(1 , Category::count());
    }

    public function test_auth_user_can_delete_category()
    {
        $this->actingAsUser();
        $category = $this->createCategory();
        $this->delete(route('panel.categories.destroy' , $category->id ));
        $this->assertEquals(0 , Category::count());
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
        return  $this->actingAs($user);
    }

    private function createCategory()
    {
        return  Category::create($this->getCategoryData());
    }

    private function getCategoryData(): array
    {
        return [
            'name' => '::digital::',
            'parent_id' => null,
            'slug' => 'table-slug',
            'status' => Category::STATUS_ACTIVE,
        ];
    }

    private function getCategoryRequestData(): array
    {
        return [
            'name' => 'table',
            'parent_id' => null,
            'slug' => 'table-slug',
            'status' => Category::STATUS_ACTIVE,
            'attribute_ids' =>  $this->getAttributeIds() ,
            'attribute_filter_ids' => $this->getAttributeIds()  ,
            'attribute_variation_id' => $this->getAttributeIds(false) ,
        ];
    }

    private function getAttributeIds($array = true)
    {
        $attribute = Attribute::create(['name' => '::size::' ]);
        if (!$array) return $attribute->id;
      return  Attribute::all()->pluck('id')->toArray();
    }
}
