<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules =  [
            'name' => ['required' , 'string' , 'min:2'] ,
            'email' => ['required' , 'email' , Rule::unique('users' ,'email') ] ,
            'password' => ['nullable' ]
        ];

        if (request()->getMethod() == 'PATCH'){
            $rules['email'] = ['required' , 'email' , Rule::unique('users' ,'email')
                ->ignore($this->route('user')->id) ] ;
        }

        return $rules;


    }
}
