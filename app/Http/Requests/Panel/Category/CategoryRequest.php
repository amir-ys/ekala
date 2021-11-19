<?php

namespace App\Http\Requests\Panel\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2' ,
            'slug' => ['required' , Rule::unique('categories' , 'slug')] ,
            'status' => ['required' , Rule::in(Category::$statuses)],
            'attribute_ids' => ['required' , 'array' ] ,
            'attribute_filter_ids' => ['required' , 'array' ] ,
            'attribute_variation_id' => ['required' ]
        ];
    }

    public function attributes()
    {
        return [
            'attribute_ids' => 'ویژگی' ,
            'attribute_filter_ids' => 'ویژگی های قابل فیلتر' ,
            'attribute_variation_ids' => 'ویژگی های متغییر'
        ];
    }
}
