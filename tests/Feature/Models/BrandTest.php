<?php

namespace Tests\Feature\Models;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Brand();
    }

    public function test_brand_relation_with_product()
    {
        $count = rand(1, 10);
        $brand = Brand::factory()->hasProducts($count)->create();

        $this->assertCount($count , $brand->products);
        $this->assertInstanceOf(Product::class , $brand->products->first());
    }
}
