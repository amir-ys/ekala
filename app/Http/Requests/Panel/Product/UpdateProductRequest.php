<?php

namespace App\Http\Requests\Panel\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'brand_id' => ['required', Rule::exists('brands', 'id')],
            'status' => ['required', Rule::in(Product::$statuses)],
            'tag_ids' => ['required', 'array' ],
            'tag_ids.*' => ['required', Rule::exists('tags', 'id')],
            'description' => ['required', 'string'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'delivery_amount' => ['required', 'numeric'],
            'delivery_amount_per_product' => ['nullable', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'برند' ,
            'category_id' => 'دسته بندی'  ,
            'tag_ids.*' => 'تگ'  ,
        ];
    }

    public function messages()
    {
        return [
            'tag_ids.*.required' => 'فیلد تگ الزامی است.'
        ];
    }
}
