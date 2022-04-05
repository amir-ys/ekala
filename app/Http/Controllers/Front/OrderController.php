<?php

namespace App\Http\Controllers\Front;

use App\Gateways\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PayRequest;
use App\Models\Coupon;
use App\Models\Product;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('front.orders.checkout');
    }

    public function pay(PayRequest $request)
    {
        $card  = $this->checkCart();
        if ( $card['status'] == 'error'){
            return back();
        }
       $amounts =  $this->getAmount();
        $this->savePaymentMethodInCache($request);
        PaymentService::generate($request->payment_method , $amounts);
        $gateway = resolve(Gateway::class);
        $gateway->redirect();
    }

    #[ArrayShape(['status' => "string", 'message' => "string"])]
    public function checkCart()
    {
        $cardIsEmpty = $this->checkCartIsEmpty();
        if ($cardIsEmpty['status'] == 'error') {
            return $this->checkCartIsEmpty();
        }

        $cartItemStatus = $this->checkCartItemAreCorrect();
        if ($cartItemStatus['status'] == 'error') {
            return $this->checkCartItemAreCorrect();
        }
        return ['status' => 'success'];

    }

    #[ArrayShape(['status' => "string", 'message' => "string"])]
    private function checkCartIsEmpty()
    {
        if (\Cart::isEmpty()) {
            return ['status' => 'error', 'message' => 'سید خرید خالی است'];
        }
        return ['status' => 'success'];
    }

    #[ArrayShape(['status' => "string", 'message' => "string"])]
    private function checkCartItemAreCorrect(): array
    {

        $carts = \Cart::getContent();
        foreach ($carts as $cartItem) {
            $product = Product::query()->find($cartItem->id);
            if ($cartItem->price != $product->price) {
                dd('price');
                \Cart::clear();
                return ['status' => 'error', 'message' => 'قیمت محصولات تغییر کرده است'];
            }

            if ($cartItem->quantity > $product->quantity) {
                \Cart::clear();
                return ['status' => 'error', 'message' => 'تعداد محصولات تغییر کرده است'];
            }
        }
        return ['status' => 'success', 'message' => 'صحیح'];
    }

    private function getAmount()
    {
        $totalAmount = \Cart::getTotal();
        $deliveryAmount = CartController::getDeliveryAmount();
        $couponAmount = is_array( $couponAmount =  $this->getCouponAmount() ) ?  $couponAmount = $couponAmount['amount'] : 0  ;
        return [
            'total_amount' => $totalAmount ,
            'delivery_amount' =>  $deliveryAmount ,
            'coupon_amount' =>  $couponAmount ,
            'paying_amount' => ($totalAmount + $deliveryAmount) - $couponAmount ,
        ];
    }

    public function getCouponAmount(): array|int
    {
        $couponAmount = 0 ;
        $code =  session('coupon.code');
        if (! $coupon = CouponController::checkCouponExists($code)){
            return $couponAmount;
        }
        if ( CouponController::checkCouponIsUsed(auth()->id() , $coupon->id )){
            return $couponAmount;
        }
       return  [ 'coupon' => $coupon , 'amount' =>  CouponController::generateCouponAmount($coupon ,$code) ];
    }

    /**
     * @param PayRequest $request
     * @return void
     * @throws \Exception
     */
    public function savePaymentMethodInCache(PayRequest $request): void
    {
        cache()->put('payment_method', $request->payment_method);
    }
}
