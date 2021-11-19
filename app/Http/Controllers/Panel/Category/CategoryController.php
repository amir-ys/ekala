<?php

namespace App\Http\Controllers\Panel\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Category\CategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return view('panel.categories.index' , compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::where('status' , 0)->get();
        $attributes = Attribute::all();
        return view('panel.categories.create' , compact('parentCategories', 'attributes'));
    }

    public function store(CategoryRequest $request)
    {

    }
}
