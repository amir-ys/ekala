<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Banner::query()->where('type', Banner::TYPE_SLIDER)
            ->where('status', Banner::STATUS_ACTIVE)->orderBy('priority')->get();
        $topIndexBanners = Banner::query()->where('type', Banner::TYPE_TOP_INDEX)
            ->where('status', Banner::STATUS_ACTIVE)->orderBy('priority')->get();
        $bottomIndexBanners = Banner::query()->where('type', Banner::TYPE_BOTTOM_INDEX)
            ->where('status', Banner::STATUS_ACTIVE)->orderBy('priority')->get();
        $products = Product::query()->with(['category', 'tags'])->where('status', Product::STATUS_ACTIVE)
            ->take(4)->latest()->get();
        return view('front.index', compact('sliders', 'topIndexBanners', 'bottomIndexBanners', 'products' ));
    }

    public function showCategory(Category $category)
    {
        $products = Product::query()->where('category_id' , $category->id)->get();
        return view('front.categories' , compact('products'));
    }

    public function productDetails(Product  $product)
    {
        return view('front.product-details' , compact('product'));
    }
}
