<?php

namespace App\Http\Requests\Panel\Banner;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
//            'image' => [ 'required' , 'mimes:jpeg,jpg,png' , 'max:5120'] ,
            'title' => [ 'required' , 'string'  ] ,
            'body' => [ 'required' , 'string'  ] ,
            'priority' => [ 'nullable' , 'numeric'  ] ,
            'status' => [ 'required' , Rule::in(Banner::$statuses)  ] ,
            'type' => [ 'nullable'] ,
            'btn_link' => [ 'required' , 'string'] ,
            'btn_text' => [ 'nullable' , 'string'] ,
            'btn_icon' => [ 'nullable' , 'string'] ,
        ];
    }
}
