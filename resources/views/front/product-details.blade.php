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
                            <a  class="{{ count($errors) > 0 ? '' : 'active' }} {{ session()->has('message') ? '' : 'active' }}" data-toggle="tab" href="#des-details1"> توضیحات </a>
                            <a  data-toggle="tab" href="#des-details3"> اطلاعات بیشتر </a>
                            <a  class="{{ count($errors) > 0 ? 'active' : '' }}{{ session()->has('message') ? 'active' : '' }}"  data-toggle="tab" href="#des-details2">دیدگاه ({{ $approvedComments->count() }})</a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane {{ count($errors) > 0 ? 'active' : '' }}{{ session()->has('message') ? '' : 'active' }}">
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
                            <div id="des-details2" class="tab-pane {{ count($errors) > 0 ? 'active' : '' }}{{ session()->has('message') ? 'active' : '' }}">

                                <div class="review-wrapper">
                                    @foreach($approvedComments as $comment)
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="" alt="">
                                        </div>
                                        <div class="review-content text-right">
                                            <p class="text-right">
                                              {{ $comment->body }}
                                            </p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4> {{ $comment->user->name }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="ratting-form-wrapper text-right">
                                    <span> نوشتن دیدگاه </span>
                                    </div>


                                @if (session()->has('message'))
                                    <p class="alert alert-success">{{ session('message') }}</p>
                                @endif

                                    <div class="ratting-form" id="comment">
                                        @auth
                                            <form action="{{ route('comment.store' , $product->id) }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="rating-form-style mb-20">
                                                            <label> متن دیدگاه : </label>
                                                            <textarea name="body"></textarea>
                                                        </div>
                                                        <x-validation-error field="body" />
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-submit">
                                                            <input type="submit" value="ارسال">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endAuth
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
@endsection
