<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Tag();
    }

    public function test_tag_relation_with_product()
    {
        $count = rand(1 ,10);
        $tag = Tag::factory()->has(Product::factory()->count($count))->create();

        $this->assertCount($count , $tag->products);
        $this->assertInstanceOf(Product::class , $tag->products->first());
    }
}
