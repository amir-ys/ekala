<?php

namespace App\Http\Controllers\Panel\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Category\CategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return view('panel.categories.index' , compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::where('parent_id' , null)->get();
        $attributes = Attribute::all();
        return view('panel.categories.create' , compact('parentCategories', 'attributes'));
    }

    public function store(CategoryRequest $request)
    {
       $category =  Category::query()->create([
            'name' => $request->name ,
            'parent_id' => $request->parent_id ,
            'slug' => Str::slug($request->slug),
            'status' => $request->status ,
            'description' => $request->description ,
            'icon' => $request->icon ,
        ]);

       foreach ($request->attribute_ids as $attribute)
       $category->attributes()->attach( $attribute , [
           'is_filter' =>  in_array($attribute ,$request->attribute_filter_ids) ? 1 : 0 ,
           'is_variation' =>   $attribute == $request->attribute_variation_ids ?   1 : 0
       ]);

       return redirect()->route('panel.categories.index');
    }
}
