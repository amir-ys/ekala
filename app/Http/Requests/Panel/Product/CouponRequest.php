<?php

namespace App\Http\Requests\Panel\Product;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'name' => 'nullable|string'  ,
            'code' => 'required|unique:coupons,code'  ,
            'type' => ['required' , Rule::in(Coupon::$types)]  ,
            'amount' => ['required_if:type,=,' . Coupon::TYPE_AMOUNT ]  ,
            'percent' => ['required_if:type,=,' . Coupon::TYPE_PERCENT ]  ,
            'expired_at' => [ 'required' ]  ,
        ];

        if (request()->getMethod() == 'PATCH'){
            $rules['code'] = ['required' , Rule::unique('coupons' , 'code')->ignore($this->route('coupon')->id)];
        }
        return  $rules;
    }
}
