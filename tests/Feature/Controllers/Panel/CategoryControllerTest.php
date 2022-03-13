<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.categories.index'));

        $response->assertOk()
            ->assertViewIs('panel.categories.index')
            ->assertViewHas('categories', Category::latest()->paginate());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.categories.create'));

        $response->assertViewIs('panel.categories.create')
            ->assertViewHasAll([
                'parentCategories' => Category::all(),
                'attributes' => Attribute::all(),
            ]);
    }

    public function test_edit_method()
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;
        $this->actingAsUser();
        $response = $this->get(route('panel.categories.edit', $category->id));

        $response->assertOk()
            ->assertViewIs('panel.categories.edit')
            ->assertViewHasAll([
                'category' => $category,
                'attributes' => Attribute::all(),
                'parentCategories' => Category::all()->filter(function ($parentCat) use ($categoryId) {
                    return $parentCat->id != $categoryId;
                }),
            ]);
    }

    public function test_store_category()
    {
        $count = rand(1 ,10);
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $attribute = Attribute::factory()->count($count)->create();
        $category = Category::factory()->make()->toArray();
        $data = array_merge($category , [ 'attribute_ids' => $attribute->pluck('id')->toArray() ,
            'attribute_filter_ids' => [1 ,2]
            ]);
        $response = $this->post(route('panel.categories.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('categories', 1);
        $this->assertDatabaseHas('categories',$category );
        $this->assertDatabaseCount('attribute_categories', $count);
    }

    public function test_update_category()
    {
        $count = rand(1 ,10);
        $category = Category::factory()->create();
        $attribute = Attribute::factory()->count($count)->create();
        $this->actingAsUser();

        $newCategory = Category::factory()->make();
        $data = array_merge($newCategory->toArray() , [ 'attribute_ids' => $attribute->pluck('id')->toArray() ,
            'attribute_filter_ids' => [1 ,2]
        ]);
        $response = $this->patch(route('panel.categories.update', $category->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('categories', 1);
        $this->assertDatabaseHas('categories',$newCategory->toArray());
        $this->assertDatabaseCount('attribute_categories', $count);
    }

    public function test_destroy_category()
    {
        $this->actingAsUser();
        $category = Category::factory()->create();

        $response = $this->delete(route('panel.categories.destroy', $category->id));

        $response->assertJson(['message' => 'دسته بندی ' .$category->name. '  با موفقیت حذف شد.']);
        $this->assertDatabaseCount('categories', 0);
        $this->assertDatabaseMissing('categories', $category->toArray());

    }
    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
