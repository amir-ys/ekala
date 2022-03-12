<?php

namespace Tests\Feature\Models;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;
    public function model()
    {
        return new Attribute();
    }

    public function test_attribute_relation_with_category()
    {
        $count = rand(1 ,10);
        $attribute = Attribute::factory()->hasCategories($count)->create();

        $this->assertCount($count , $attribute->categories);
        $this->assertInstanceOf(Category::class , $attribute->categories->first());
    }

    public function test_attribute_relation_with_product()
    {
        $count = rand(1 ,10);
        $attribute = Attribute::factory()->hasAttached(Product::factory()->count($count) , ['value' => '::لباس::'])->create();

        $this->assertCount($count , $attribute->products);
        $this->assertInstanceOf(Product::class , $attribute->products->first());
    }
}
