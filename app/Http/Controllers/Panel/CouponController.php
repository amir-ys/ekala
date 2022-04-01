<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('panel.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('panel.coupons.create');
    }

    public function store(CouponRequest $request)
    {
        if (createCarbonFormatFromPersian($request->expired_at) <  now()){
            newFeedback(
                'ناموفق' ,
            'تاریخ وارد شده باید از تاریخ حال بزرگتر باشد' ,
                'warning'
            );
            return  back();
        }
        Coupon::create([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'amount' => $request->amount,
            'percent' => $request->percent,
            'expired_at' =>  createCarbonFormatFromPersian($request->expired_at),
        ]);
        return redirect()->route('panel.coupons.index');
    }

    public function edit( Coupon $coupon)
    {
        return view('panel.coupons.edit' , compact('coupon'));
    }

    public function update(CouponRequest $request ,  Coupon $coupon)
    {
        if (createCarbonFormatFromPersian($request->expired_at) <  now()){
            newFeedback(
                'ناموفق' ,
                'تاریخ وارد شده باید از تاریخ حال بزرگتر باشد' ,
                'warning'
            );
            return  back();
        }
        $coupon->update([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'amount' => $request->amount,
            'percent' => $request->percent,
            'expired_at' =>  createCarbonFormatFromPersian($request->expired_at),
        ]);
        return redirect()->route('panel.coupons.index');    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['message' => 'تخفیف با موفقیت حذف شد.']);
    }
}
