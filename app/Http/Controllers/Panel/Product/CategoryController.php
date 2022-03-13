<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\CategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return view('panel.categories.index' , compact('categories'));
    }

    public function show(Category $category)
    {
        return view('panel.categories.show' , compact('category'));
    }

    public function create()
    {
        $parentCategories = Category::all();
        $attributes = Attribute::all();
        return view('panel.categories.create' , compact('parentCategories', 'attributes'));
    }

    public function edit(Category $category)
    {
        $categoryId = $category->id;
        $parentCategories = Category::all()->filter(function ($category) use($categoryId){
            return $category->id != $categoryId ;
    });
        $attributes = Attribute::all();
        return view('panel.categories.edit' , compact('category'  ,'attributes' , 'parentCategories'));
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
//           'is_variation' =>   $attribute == $request->attribute_variation_id ?   1 : 0
            ]);
        newFeedback(null , 'دسته بندی با موفقیت ایجاد شد . ');
        return redirect()->route('panel.categories.index');
    }

    public function update(CategoryRequest $request , Category $category)
    {
        $category->update([
            'name' => $request->name ,
            'parent_id' => $request->parent_id ,
            'slug' => Str::slug($request->slug),
            'status' => $request->status ,
            'description' => $request->description ,
            'icon' => $request->icon ,
        ]);

        $category->attributes()->detach();
        foreach ($request->attribute_ids as $attribute)
            $category->attributes()->attach( $attribute , [
                'is_filter' =>  in_array($attribute ,$request->attribute_filter_ids) ? 1 : 0 ,
//                'is_variation' =>   $attribute == $request->attribute_variation_id ?   1 : 0
            ]);
        newFeedback(null , 'دسته بندی با موفقیت یروزرسانی شد . ');
        return redirect()->route('panel.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'دسته بندی ' .$category->name. '  با موفقیت حذف شد.']);
    }
}
