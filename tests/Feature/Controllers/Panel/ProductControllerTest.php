<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response =  $this->get(route('panel.products.index'));

        $response->assertViewIs('panel.products.index')
            ->assertViewHas('products' , Product::query()->latest()->paginate());
    }

    public function test_create_method()
    {
        $count = rand(2 ,10);
        $this->actingAsUser();
        Brand::factory()->count($count)->create();
        Category::factory()->count($count)->create();
        Tag::factory()->count($count)->create();

        $response =  $this->get(route('panel.products.create'));

        $response->assertViewIs('panel.products.create')
            ->assertViewHasAll([
                'brands' =>  Brand::all() ,
                'categories' =>  Category::all() ,
                'tags' =>  Tag::all() ,
            ] );
    }

    public function test_edit_method()
    {
        $count = rand(2 ,10);
        $this->actingAsUser();
        $product = Product::factory()->create();
        Brand::factory()->count($count)->create();
        Category::factory()->count($count)->create();
        Tag::factory()->count($count)->create();

        $response =  $this->get(route('panel.products.edit' , $product->id));

        $response->assertViewIs('panel.products.edit')
            ->assertViewHasAll([
                'product' =>  $product ,
                'brands' =>  Brand::all() ,
                'categories' =>  Category::all() ,
                'tags' =>  Tag::all() ,
            ] );
    }

    public function test_show_method()
    {
        $count = rand(2 ,10);
        $this->actingAsUser();
        $product = Product::factory()->create();
        Brand::factory()->count($count)->create();
        Category::factory()->count($count)->create();
        Tag::factory()->count($count)->create();

        $response =  $this->get(route('panel.products.edit' , $product->id));

        $response->assertViewIs('panel.products.edit')
            ->assertViewHasAll([
                'product' =>  $product ,
                'brands' =>  Brand::all() ,
                'categories' =>  Category::all() ,
                'tags' =>  Tag::all() ,
            ] );
    }

    public function test_store_product()
    {
        $count = rand(5, 15);
        $this->actingAsUser();
        Tag::factory()->count($count)->create();
        $productData = Product::factory()->make()->toArray();

        $data = $productData;
        $data['tag_ids'] = Tag::query()->inRandomOrder()->pluck('id')->toArray();
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $data['images'] = [
            UploadedFile::fake()->image('image-1.png') ,
            UploadedFile::fake()->image('image-2.jpeg') ,
            UploadedFile::fake()->image('image-3.jpg') ,
            UploadedFile::fake()->image('image-4.png') ,
        ];

        $response =  $this->post(route('panel.products.store') , $data);
        $response->assertRedirect();
        $this->assertDatabaseCount('products' ,1);
        $this->assertDatabaseCount('tag_product' , count($data['tag_ids']));
        $this->assertDatabaseHas('products' ,$productData);
    }



    public function test_update_product()
    {
        $count = rand(5, 15);
        $this->actingAsUser();
        $product = Product::factory()->create();
        Tag::factory()->count($count)->create();
        $productData = Product::factory()->make()->toArray();

        $data = $productData;
        $data['tag_ids'] = Tag::query()->inRandomOrder()->pluck('id')->toArray();
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $data['images'] = [
            UploadedFile::fake()->image('image-1.png') ,
            UploadedFile::fake()->image('image-2.jpeg') ,
            UploadedFile::fake()->image('image-3.jpg') ,
            UploadedFile::fake()->image('image-4.png') ,
        ];

        $response =  $this->patch(route('panel.products.update' , $product->id) , $data);


        $response->assertRedirect();
        $this->assertDatabaseCount('products' ,1);
        $this->assertDatabaseCount('tag_product' , count($data['tag_ids']));
        $this->assertDatabaseHas('products' ,$productData);
    }

    public function test_destroy_product ()
    {
        $count = rand(5, 15);
        $this->actingAsUser();
        Tag::factory()->count($count)->create();
        $productData = Product::factory()->make()->toArray();

        $data = $productData;
        $data['tag_ids'] = Tag::query()->inRandomOrder()->pluck('id')->toArray();
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $data['images'] = [
            UploadedFile::fake()->image('image-1.png') ,
            UploadedFile::fake()->image('image-2.jpeg') ,
            UploadedFile::fake()->image('image-3.jpg') ,
            UploadedFile::fake()->image('image-4.png') ,
        ];
         $this->post(route('panel.products.store') , $data);

         $product = Product::first();

         $response = $this->delete(route('panel.products.destroy' , $product->id));

         $response->assertJson([
             'message' => 'محصول ' . $product->name.' با موفقیت حذف شد.'
         ]);

         $this->assertDatabaseCount('products' , 0);
         $this->assertDatabaseCount('tag_product' , 0);
         $this->assertDatabaseMissing('products' , $product->toArray());

    }
    private function actingAsUser()
    {
        $this->actingAs(User::factory()->create());
    }

}
