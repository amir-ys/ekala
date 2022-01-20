<?php

namespace App\Http\Requests\Panel\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required' , 'string'] ,
            'price' => ['required' , 'numeric'] ,
            'quantity' => ['required' , 'numeric'] ,
            'brand_id' => ['required' , Rule::exists('brands' , 'id')] ,
            'status' => ['required' , Rule::in(Product::$statuses)] ,
            'tag_id' => ['required' , Rule::exists('tags' , 'id')] ,
            'description' => ['required' , 'string'] ,
            'primary_image' => ['required' , 'mimes:jpg,jpeg,png'] ,
            'images.*' => ['required' , 'mimes:jpg,jpeg,png'] ,
            'category_id' => ['required' , Rule::exists('categories' , 'id')] ,
            'attribute_ids.*' => ['required'] ,
            'delivery_amount' => ['required' , 'numeric'] ,
            'delivery_amount_per_product' => ['nullable' , 'numeric'] ,
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'برند'  ,
            'tag_id' => 'برند'  ,
            'category_id' => 'برند'  ,
            'primary_image' => 'تصویر اصلی'  ,
        ];
    }
}
