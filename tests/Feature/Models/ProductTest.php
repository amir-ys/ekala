<?php

namespace Tests\Feature\Models;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Product();
    }

    public function test_product_relation_with_brand()
    {
        $product = Product::factory()->for(Brand::factory())->create();

        $this->assertTrue(isset($product->brand->id));
        $this->assertInstanceOf(Brand::class , $product->brand);
    }

    public function test_product_relation_with_category()
    {
        $product = Product::factory()->for(Category::factory())->create();

        $this->assertTrue(isset($product->category->id));
        $this->assertInstanceOf(Category::class , $product->category);
    }

    public function test_product_relation_with_attribute()
    {
        $count = rand(1 ,10);
        $product = Product::factory()->hasAttached(Attribute::factory()->count($count) , [ 'value' => '::قرمز::' ])->create();

        $this->assertCount($count , $product->attributes);
        $this->assertInstanceOf(Attribute::class , $product->attributes->first());
    }

    public function test_product_relation_with_tag()
    {
        $count = rand(1 ,10);
        $product = Product::factory()->has(Tag::factory()->count($count))->create();

        $this->assertCount($count , $product->tags);
        $this->assertInstanceOf(Tag::class , $product->tags->first());
    }
}
