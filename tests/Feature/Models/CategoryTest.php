<?php

namespace Tests\Feature\Models;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Category();
    }

    public function test_category_relation_with_parent()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->state(['parent_id' => $category1['id'] ])->create();

        $this->assertDatabaseCount('categories' , 2);
        $this->assertEquals($category1->id , $category2->parent_id);
    }

    public function test_category_relation_with_attribute()
    {
        $count = rand(1 ,10);
        $category = Category::factory()->has(Attribute::factory()->count($count) ,
            'attributes')->create();

        $this->assertCount($count , $category->attributes);
        $this->assertInstanceOf(Attribute::class , $category->attributes->first());
    }
}
