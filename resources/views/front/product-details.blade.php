@extends('front.layouts.master')
@section('content')
    <div class="product-details-area pt-100 pb-95">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                    <div class="product-details-content ml-30">
                        <h2 class="text-right"> {{ $product->title }}</h2>
                        <div class="product-details-price">
                                <span>
                                    18000
                                    تومان
                                </span>
                            <span class="old">
                                    {{ $product->price }}
                                    تومان
                                </span>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="pro-details-rating">
                                <i class="sli sli-star yellow"></i>
                                <i class="sli sli-star yellow"></i>
                                <i class="sli sli-star yellow"></i>
                                <i class="sli sli-star yellow"></i>
                                <i class="sli sli-star yellow"></i>
                            </div>
                            <span>
                                    <a href="#">
                                        3
                                        دیدگاه
                                    </a>
                                </span>
                        </div>
                        <p class="text-right">
                            {{ $product->description }}
                        </p>
                        <div class="pro-details-list text-right">
                            <ul>
                                @foreach($product->attributes()->withPivot('value')->get()  as $productAttribute)
                                <li> -{{ $productAttribute->name }} : {{ $productAttribute->pivot->value }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="pro-details-size-color">

{{--                            <div class="pro-details-size text-right">--}}
{{--                                <span> سایز </span>--}}
{{--                                <div class="pro-details-size-content">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">s</a></li>--}}
{{--                                        <li><a href="#">m</a></li>--}}
{{--                                        <li><a href="#">l</a></li>--}}
{{--                                        <li><a href="#">xl</a></li>--}}
{{--                                        <li><a href="#">xxl</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                <a href="#"> افزودن به سبد خرید </a>
                            </div>
                            <div class="pro-details-wishlist">
                                <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                            </div>
                            <div class="pro-details-compare">
                                <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-meta">
                            <span> دسته بندی : </span>
                            <ul>
                                <li><a href=""> {{ $product->category->name }} </a></li>
                                    @if($product->category->childerns)
                                        @foreach($product->category->childerns as $childCat)
                                            <li><a href="{{ $childCat->path() }}"> {{ $childCat->name }} </a></li>
                                        @endforeach
                                    @endif
                            </ul>
                        </div>
                        <div class="pro-details-meta">
                            <span> تگ : </span>
                            <ul>
                                @foreach($product->tags as $tag)
                                <li><a href="#"> {{ $tag->name }}{{ $loop->last ? '' : ','  }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro"
                                 src="{{ route('panel.products.displayImage' , $product->images()->where('is_primary' , 1)->first()->files ) }}"
                                 data-zoom-image="{{ route('panel.products.displayImage' , $product->images()->where('is_primary' , 1)->first()->files ) }}"
                                 alt="" />

                        </div>
                        @foreach($product->images as $image)
                        <div id="gallery" class="mt-20 product-dec-slider">
                            <a data-image="{{ route('panel.products.displayImage' , $image->files )}}"
                               data-zoom-image="{{ route('panel.products.displayImage' , $image->files )}}">
                                <img src="{{ route('panel.products.displayImage' , $image->files )}}" alt="" width="50" height="50">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="description-review-area pb-95">
        <div class="container">
            <div class="row" style="direction: rtl;">
                <div class="col-lg-8 col-md-8">
                    <div class="description-review-wrapper">
                        <div class="description-review-topbar nav">
                            <a class="active" data-toggle="tab" href="#des-details1"> توضیحات </a>
                            <a data-toggle="tab" href="#des-details3"> اطلاعات بیشتر </a>
                            <a data-toggle="tab" href="#des-details2">
                                دیدگاه
                                (3)
                            </a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane active">
                                <div class="product-description-wrapper">
                                   {{ $product->descripion }}
                                </div>
                            </div>
                            <div id="des-details3" class="tab-pane">
                                <div class="product-anotherinfo-wrapper text-right">
                                    <ul>
                                        @foreach($product->attributes()->withPivot('value')->get()  as $productAttribute)
                                            <li> -{{ $productAttribute->name }} : {{ $productAttribute->pivot->value }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">

                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-1.jpg" alt="">
                                        </div>
                                        <div class="review-content text-right">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است.
                                            </p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-2.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                ستون و سطرآنچنان که لازم است
                                            </p>
                                            <div class="review-top-wrap text-right">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-3.jpg" alt="">
                                        </div>
                                        <div class="review-content text-right">
                                            <p class="text-right">
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                ستون و سطرآنچنان که لازم است
                                            </p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4> علی شیخ </h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ratting-form-wrapper text-right">
                                    <span> نوشتن دیدگاه </span>

                                    <div class="star-box-wrap">
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                    </div>

                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label> متن دیدگاه : </label>
                                                        <textarea name="Your Review"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <input type="submit" value="ارسال">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="pro-dec-banner">
                        <a href="#"><img src="assets/img/banner/banner-7.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2> محصولات مرتبط </h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله
                </p>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">
                    <!--Product Start-->
                    <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                            <div class="ht-product-image-wrap">
                                <a href="product-details.html" class="ht-product-image">
                                    <img src="assets/img/product/product-1.svg" alt="Universal Product Style" />
                                </a>
                                <div class="ht-product-action">
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="sli sli-magnifier"></i><span
                                                    class="ht-product-action-tooltip"> مشاهده سریع
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-heart"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به
                                                        علاقه مندی ها </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-refresh"></i><span
                                                    class="ht-product-action-tooltip"> مقایسه
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-bag"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به سبد
                                                        خرید </span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ht-product-content">
                                <div class="ht-product-content-inner">
                                    <div class="ht-product-categories">
                                        <a href="#">لورم</a>
                                    </div>
                                    <h4 class="ht-product-title text-right">
                                        <a href="product-details.html"> لورم ایپسوم </a>
                                    </h4>
                                    <div class="ht-product-price">
                                            <span class="new">
                                                55,000
                                                تومان
                                            </span>
                                        <span class="old">
                                                75,000
                                                تومان
                                            </span>
                                    </div>
                                    <div class="ht-product-ratting-wrap">
                                            <span class="ht-product-ratting">
                                                <span class="ht-product-user-ratting" style="width: 100%;">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </span>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                            </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Product End-->
                    <!--Product Start-->
                    <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                            <div class="ht-product-image-wrap">
                                <a href="product-details.html" class="ht-product-image">
                                    <img src="assets/img/product/product-2.svg" alt="Universal Product Style" />
                                </a>
                                <div class="ht-product-action">
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="sli sli-magnifier"></i><span
                                                    class="ht-product-action-tooltip"> مشاهده سریع
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-heart"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به
                                                        علاقه مندی ها </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-refresh"></i><span
                                                    class="ht-product-action-tooltip"> مقایسه
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-bag"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به سبد
                                                        خرید </span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ht-product-content">
                                <div class="ht-product-content-inner">
                                    <div class="ht-product-categories">
                                        <a href="#">لورم </a>
                                    </div>
                                    <h4 class="ht-product-title text-right">
                                        <a href="product-details.html">لورم ایپسوم</a>
                                    </h4>
                                    <div class="ht-product-price">
                                            <span class="new">
                                                25,000
                                                تومان
                                            </span>
                                    </div>
                                    <div class="ht-product-ratting-wrap">
                                            <span class="ht-product-ratting">
                                                <span class="ht-product-user-ratting" style="width: 100%;">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </span>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                            </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Product End-->
                    <!--Product Start-->
                    <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                            <div class="ht-product-image-wrap">
                                <a href="product-details.html" class="ht-product-image">
                                    <img src="assets/img/product/product-3.svg" alt="Universal Product Style" />
                                </a>
                                <div class="ht-product-action">
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="sli sli-magnifier"></i><span
                                                    class="ht-product-action-tooltip"> مشاهده سریع
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-heart"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به
                                                        علاقه مندی ها </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-refresh"></i><span
                                                    class="ht-product-action-tooltip"> مقایسه
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-bag"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به سبد
                                                        خرید </span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ht-product-content">
                                <div class="ht-product-content-inner">
                                    <div class="ht-product-categories">
                                        <a href="#">لورم</a>
                                    </div>
                                    <h4 class="ht-product-title text-right">
                                        <a href="product-details.html">لورم ایپسوم</a>
                                    </h4>
                                    <div class="ht-product-price">
                                            <span class="new">
                                                60,000
                                                تومان
                                            </span>
                                        <span class="old">
                                                90,000
                                                تومان
                                            </span>
                                    </div>
                                    <div class="ht-product-ratting-wrap">
                                            <span class="ht-product-ratting">
                                                <span class="ht-product-user-ratting" style="width: 100%;">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </span>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                            </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Product End-->
                    <!--Product Start-->
                    <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                            <div class="ht-product-image-wrap">
                                <a href="product-details.html" class="ht-product-image">
                                    <img src="assets/img/product/product-4.svg" alt="Universal Product Style" />
                                </a>
                                <div class="ht-product-action">
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="sli sli-magnifier"></i><span
                                                    class="ht-product-action-tooltip"> مشاهده سریع
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-heart"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به
                                                        علاقه مندی ها </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-refresh"></i><span
                                                    class="ht-product-action-tooltip"> مقایسه
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-bag"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به سبد
                                                        خرید </span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ht-product-content">
                                <div class="ht-product-content-inner">
                                    <div class="ht-product-categories">
                                        <a href="#">لورم</a>
                                    </div>
                                    <h4 class="ht-product-title text-right">
                                        <a href="product-details.html">لورم ایپسوم</a>
                                    </h4>
                                    <div class="ht-product-price">
                                            <span class="new">
                                                60,000
                                                تومان
                                            </span>
                                    </div>
                                    <div class="ht-product-ratting-wrap">
                                            <span class="ht-product-ratting">
                                                <span class="ht-product-user-ratting" style="width: 100%;">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </span>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Product End-->
                    <!--Product Start-->
                    <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                            <div class="ht-product-image-wrap">
                                <a href="product-details.html" class="ht-product-image">
                                    <img src="assets/img/product/product-2.svg" alt="Universal Product Style" />
                                </a>
                                <div class="ht-product-action">
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="sli sli-magnifier"></i><span
                                                    class="ht-product-action-tooltip"> مشاهده سریع
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-heart"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به
                                                        علاقه مندی ها </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-refresh"></i><span
                                                    class="ht-product-action-tooltip"> مقایسه
                                                    </span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="sli sli-bag"></i><span
                                                    class="ht-product-action-tooltip"> افزودن به سبد
                                                        خرید </span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ht-product-content">
                                <div class="ht-product-content-inner">
                                    <div class="ht-product-categories">
                                        <a href="#">لورم </a>
                                    </div>
                                    <h4 class="ht-product-title text-right">
                                        <a href="product-details.html">لورم ایپسوم</a>
                                    </h4>
                                    <div class="ht-product-price">
                                            <span class="new">
                                                60,000
                                                تومان
                                            </span>
                                    </div>
                                    <div class="ht-product-ratting-wrap">
                                            <span class="ht-product-ratting">
                                                <span class="ht-product-user-ratting" style="width: 100%;">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </span>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                                <i class="sli sli-star"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Product End-->
                </div>
            </div>
        </div>
    </div>
@endsection
