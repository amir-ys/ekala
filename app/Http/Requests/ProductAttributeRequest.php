<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAttributeRequest extends FormRequest
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
            'attribute_ids' => [ 'array'] ,
            'attribute_ids.*' => [ 'required'] ,
        ];
    }

    public function messages()
    {
        return [
            'attribute_ids.*.required' => 'فیلد مورد نظر اجباری است.'
        ];
    }
}
