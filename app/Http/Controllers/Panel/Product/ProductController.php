<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function create()
    {
        $brands =Brand::all();
        $categories =Category::all();
        return view('panel.products.create' , compact('brands' , 'categories'));
    }
}
