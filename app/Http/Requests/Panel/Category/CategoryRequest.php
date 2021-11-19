<?php

namespace App\Http\Requests\Panel\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Type;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules =  [
            'name' => 'required|min:2' ,
            'slug' => ['required' , Rule::unique('categories' , 'slug')] ,
            'status' => ['required' , Rule::in(Category::$statuses)],
            'attribute_ids' => ['required' , 'array' ] ,
            'attribute_filter_ids' => ['required' , 'array' ] ,
            'attribute_variation_id' => ['required' ]
        ];

        if (request()->method() == 'PATCH'){
            $rules['slug'] = ['required' , Rule::unique('categories' )->ignore($this->route('category')->id)];
        }

        return $rules ;
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
