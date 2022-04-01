<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CouponRequest;
use App\Models\Coupon;
use App\Models\Order;

class CouponController extends Controller
{
    public function checkCoupon(CouponRequest $request)
    {
        $coupon = Coupon::query()->where('code' , $request->code )->where('expired_at' , '>'  , now())->first();
        if (!$coupon){
            return back();
        }


        $couponUsed =  Order::query()->where('user_id' , auth()->id())->where('coupon_id' , $coupon->id )
        ->where('payment_status' , Order::STATUS_SUCCESS)->first();
        if ($couponUsed){
            return back();
        }


        if ($coupon->type == Coupon::TYPE_AMOUNT){
            session()->put('coupon' , $coupon->amount );
        }elseif ($coupon->type == Coupon::TYPE_PERCENT){
            $amount = ((\Cart::getTotal() * $coupon->percent) / 100) ;
            session()->put('coupon' , $amount );
        }

        return  back();
    }
}
