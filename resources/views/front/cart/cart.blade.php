@extends('front.layouts.master')
@section('content')
    <div class="cart-main-area pt-95 pb-100 text-right" style="direction: rtl;">
        <div class="container">
            <h3 class="cart-page-title"> سبد خرید شما </h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    @if($carts->count() > 0)
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                <tr>
                                    <th> تصویر محصول</th>
                                    <th> نام محصول</th>
                                    <th> فی</th>
                                    <th> تعداد</th>
                                    <th> قیمت</th>
                                    <th> عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cartItem)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img width="200px"
                                                             src="{{ route('panel.products.displayImage' ,
 $cartItem->associatedModel->images()->where('is_primary' , 1)->first()->files) }}"
                                                             alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#"> {{ $cartItem->name }} </a></td>
                                        <td class="product-price-cart"><span class="amount">
                                                   {{ number_format($cartItem->price) }}
                                                    تومان
                                                </span></td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                       value="{{ $cartItem->quantity }}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            {{ number_format($cartItem->price * $cartItem->quantity) }}
                                            تومان
                                        </td>
                                        <td class="product-remove">
                                            <form action="{{ route('front.cart.remove' , $cartItem->id) }}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"><i class="sli sli-close"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="#"> ادامه خرید </a>
                                    </div>
                                    <button> به روز رسانی سبد خرید</button>
                                    <div class="cart-clear">
                                        <form action="{{ route('front.cart.clear' , $cartItem->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger "> پاک کردن سبد خرید<i
                                                    class="sli sli-close"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">

                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray"> کد تخفیف </h4>
                                    </div>
                                    <div class="discount-code">
                                        <p> لورم ایپسوم متن ساختگی با تولید سادگی </p>
                                        <form  action="{{ route('front.coupon.check') }}" method="get">
                                            @csrf
                                            <input type="text" name="code" value="{{ old('code') }}" >
                                            <x-validation-error  field="code" />
                                            <button class="cart-btn-2" type="submit"> ثبت</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart"> مجموع سفارش </h4>
                                    </div>
                                    <h5>
                                        مبلغ سفارش :
                                        <span>
                                            {{    number_format( $total = \Cart::getTotal()) }}
                                            تومان
                                        </span>
                                    </h5>
                                    <div class="total-shipping">
                                        <h5>
                                            هزینه ارسال :
                                            <span>

                                                {{ number_format(\App\Http\Controllers\Front\CartController::getDeliveryAmount()) }}
                                            تومان
                                            </span>
                                        </h5>

                                    </div>
                                    <div class="discount-code">
                                        <h5>
                                            مبلغ کد تخفیف :
                                            <span>
                                                @if(session()->has('coupon'))
                                                    {{  number_format($couponAmount = session()->get('coupon')['amount'] ) }}
                                                @else
                                                    {{ $couponAmount = 0 }}
                                                @endif
                                            </span>
                                        </h5>

                                    </div>
                                    <hr>
                                    <h4 class="grand-totall-title">
                                        جمع کل:
                                        <span>
                                            {{ ( $total +  \App\Http\Controllers\Front\CartController::getDeliveryAmount() ) - $couponAmount   }}
                                            تومان
                                        </span>
                                    </h4>
                                    <a href="{{ route('front.orders.checkout') }}"> ادامه فرآیند خرید </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="container cart-empty-content">
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                    <i class="sli sli-basket"></i>
                                    <h2 class="font-weight-bold my-4">سبد خرید خالی است.</h2>
                                    <p class="mb-40">شما هیچ کالایی در سبد خرید خود ندارید.</p>
                                    <a href="shop.html"> ادامه خرید </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop



