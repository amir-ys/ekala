<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\StoreProductRequest;
use App\Http\responses\AjaxResponse;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Services\Media\MediaFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        dd('dfffff');
    }
    public function create()
    {
        $brands =Brand::all();
        $categories =Category::all();
        $tags = Tag::all();
        return view('panel.products.create' , compact('brands' , 'categories' , 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
//        dd($request->all());
        DB::transaction(function () use ($request) {
            $product =  Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'status' => $request->status,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);
            if ($request->hasFile('primary_image')){
                MediaFileService::publicUpload($request->primary_image , $product->id , 'products' , true );
            }
            if ($request->hasFile('images') ){
                $images = $request->images;
                foreach ($images as $image){
                    MediaFileService::publicUpload($image , $product->id , 'products' , false );
                }
            }
            $attributes = $request->attribute_ids ;
            foreach ($attributes as $attribute => $value)
            $product->attributes()->attach($attribute , [ 'value' => $value]);
        });
        return back();
    }

    public function getCategoryAttribute($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category){
           return AjaxResponse::error('دسته بندی با این  ایدی پیدا نشد.');
        }
        $attributes = $category->attributes()->wherePivot('is_variation' , 0)->get();
        $variation = $category->attributes()->wherePivot('is_variation' , 1)->first();
        return  AjaxResponse::sendData(['attributes' => $attributes , 'variation' => $variation] ,
            'ویژگی های دسته بندی با موفقیت پیدا شد .');
    }
}
