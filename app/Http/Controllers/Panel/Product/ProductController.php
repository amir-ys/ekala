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
