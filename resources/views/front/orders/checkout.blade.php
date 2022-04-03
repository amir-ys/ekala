@extends('front.layouts.master')
@section('content')
    <div class="checkout-main-area pt-70 pb-70 text-right" style="direction: rtl;">

        <div class="container">

            <div class="customer-zone mb-20">
                <p class="cart-page-title">
                    کد تخفیف دارید؟
                    <a class="checkout-click3" href="#"> میتوانید با کلیک در این قسمت کد خود را اعمال کنید </a>
                </p>
                <div class="checkout-login-info3">
                    <form action="#">
                        <input type="text" placeholder="کد تخفیف">
                        <input type="submit" value="اعمال کد تخفیف">
                    </form>
                </div>
            </div>

            <div class="checkout-wrap pt-30">
                <div class="row">

                    <div class="col-lg-7">
                    </div>

                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3> سفارش شما </h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li> محصول <span> جمع </span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach($carts =  \Cart::getContent() as $cartItem)
                                                <li>
                                                    {{ $cartItem->name }}
                                                    <span>
                                                        {{ number_format($cartItem->price) }}
                                                        تومان
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li> مبلغ
                                                <span>
                                                        {{ number_format($total =  \Cart::getTotal()) }}
                                                        تومان
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li> هزینه ارسال
                                                <span>
                                                {{ number_format(\App\Http\Controllers\Front\CartController::getDeliveryAmount()) }}
                                                    تومان
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>جمع کل
                                                <span>
                                            {{ number_format(( $total +  \App\Http\Controllers\Front\CartController::getDeliveryAmount()))    }}
                                            تومان
                                        </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <form action="{{ route('front.orders.pay') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="payment-method">
                                            @foreach(config('payment_method') as $paymentMethod => $paymentInfo)
                                        <div class="pay-top sin-payment">
                                            <input id="{{ $paymentMethod }}" class="input-radio" type="radio" value="{{  $paymentMethod }}"
                                                   checked="checked" name="payment_method">
                                            <label for="zarinpal"> {{ $paymentInfo['name'] }} </label>
                                        </div>
                                         @endforeach
                                    </div>
                                    <div class="Place-order mt-40">
                                        <button type="submit">ثبت سفارش</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
@stop
