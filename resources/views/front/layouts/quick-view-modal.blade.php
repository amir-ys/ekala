<div class="modal fade" id="quick-view-modal-{{ $product->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                        <div class="product-details-content quickview-content">
                            <h2 class="text-right mb-4">{{ $product->name }}</h2>
                            <div class="product-details-price">
                    <span>
                      50,000
                      تومان
                    </span>
                                <span class="old">
                      {{ number_format($product->price) }}
                      تومان
                    </span>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="pro-details-rating">
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star"></i>
                                    <i class="sli sli-star"></i>
                                </div>
                                <span>3 دیدگاه</span>
                            </div>
                            <p class="text-right">
                               {{ $product->description }}
                            </p>
                            <div class="pro-details-list text-right">
                                <ul class="text-right">
                                    @foreach($product->attributes()->withPivot('value')->get() as $productAttribute)

                                    <li>- {{ $productAttribute->name  }} : {{ $productAttribute->pivot->value }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pro-details-size-color text-right">
{{--                                <div class="pro-details-size">--}}
{{--                                    <span>سایز</span>--}}
{{--                                    <div class="pro-details-size-content">--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="#">s</a></li>--}}
{{--                                            <li><a href="#">m</a></li>--}}
{{--                                            <li><a href="#">l</a></li>--}}
{{--                                            <li><a href="#">xl</a></li>--}}
{{--                                            <li><a href="#">xxl</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2" />
                                </div>
                                <div class="pro-details-cart">
                                    <a href="#">افزودن به سبد خرید</a>
                                </div>
                                <div class="pro-details-wishlist">
                                    <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                </div>
                                <div class="pro-details-compare">
                                    <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                </div>
                            </div>
                            <div class="pro-details-meta">
                                <span>دسته بندی :</span>
                                <ul>
                                    <li><a href="#">{{ $product->category->name }}</a></li>
                                    @if($product->categories)
                                        @foreach($product->categories as $childCategory)
                                            <li><a href="#">{{ $childCategory->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="pro-details-meta">
                                <span>تگ ها :</span>
                                <ul>
                                    @foreach($product->tags as $tag)
                                        <li><a href="#">{{ $tag->name }}{{ $loop->last ?  '' : ',' }} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="tab-content quickview-big-img">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="/front-ui/assets/img/product/quickview-l1.svg" alt="" />
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="/front-ui/assets/img/product/quickview-l2.svg" alt="" />
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="/front-ui/assets/img/product/quickview-l3.svg" alt="" />
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="/front-ui/assets/img/product/quickview-l2.svg" alt="" />
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="/front-ui/assets/img/product/quickview-s1.svg"
                                                                                       alt="" /></a>
                                <a data-toggle="tab" href="#pro-2"><img src="/front-ui/assets/img/product/quickview-s2.svg" alt="" /></a>
                                <a data-toggle="tab" href="#pro-3"><img src="/front-ui/assets/img/product/quickview-s3.svg" alt="" /></a>
                                <a data-toggle="tab" href="#pro-4"><img src="/front-ui/assets/img/product/quickview-s2.svg" alt="" /></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
