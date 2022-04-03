<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CouponRequest;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class CouponController extends Controller
{

    public function checkCoupon(CouponRequest $request): RedirectResponse
    {
        $coupon = self::checkCouponExists($request->code);
        if (!$coupon){
            return back();
        }

        $couponUsed = self::checkCouponIsUsed(auth()->id() , $coupon->id);
        if ($couponUsed){
            return back();
        }

        self::generateCouponAmount($coupon, $request->code);
        return  redirect()->route('front.coupon.check');
    }

    public static function generateCouponAmount($coupon, $code): int
    {
        $couponAmount = 0 ;
        if ($coupon->type == Coupon::TYPE_AMOUNT) {
             session()->put('coupon', ['code' => $code, 'amount' => $couponAmount = $coupon->amount]);
        } elseif ($coupon->type == Coupon::TYPE_PERCENT) {
            $couponAmount = ((\Cart::getTotal() * $coupon->percent) / 100);
            session()->put('coupon', ['code' => $code, 'amount' => $couponAmount]);
        }
        return $couponAmount;
    }

    public static function checkCouponIsUsed($user_id , $couponId)
    {
        return Order::query()->where('user_id', auth()->id())->where('coupon_id', $couponId)
            ->where('status', Order::STATUS_SUCCESS)->first();
    }

    public static function checkCouponExists($code )
    {
        return Coupon::query()->where('code',  $code)->where('expired_at', '>' , now())->first();
    }

}
