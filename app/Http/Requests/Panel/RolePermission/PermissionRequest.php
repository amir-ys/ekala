<?php


namespace App\Http\Requests\Panel\RolePermission;


use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest

{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fa_name' => 'string|min:3' ,
            'name' => 'required|string|min:3|unique:permissions,name'
        ];
    }
}
