<?php


namespace App\Http\Requests\Panel\RolePermission;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest

{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $roles =  [
            'fa_name' => 'string|min:3' ,
            'name' => ['required' , 'string' , 'min:3' , Rule::unique('roles' , 'name' )] ,
            'permissions' => ['required' , 'array' ] ,
            'permissions.*' => [ 'numeric' , Rule::exists('permissions' , 'id') ] ,
        ];

        if (request()->getMethod() == "PATCH"){
            $roles['name'] = ['required' , 'string' , 'min:3' , Rule::unique('roles' , 'name' )
                ->ignore($this->route('role')->id)];
        }

        return $roles;
    }
}
