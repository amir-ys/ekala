<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layouts.head')
</head>
<body class="boxed rtl">
<!-- Loader -->
<div id="loader-wrapper" class="off">
    <div class="cube-wrapper">
        <div class="cube-folding">
            <span class="leaf1"></span>
            <span class="leaf2"></span>
            <span class="leaf3"></span>
            <span class="leaf4"></span>
        </div>
    </div>
</div>
<!-- /Loader -->
<div class="fixed-btns">
    <!-- Back To Top -->
    <a href="#" class="top-fixed-btn back-to-top"><i class="icon icon-arrow-up"></i></a>
    <!-- /Back To Top -->
</div>
<div id="wrapper">
    <!-- Page -->
    <div class="page-wrapper">
        <!-- Header -->
        @include('front.layouts.header')
        <!-- /Header -->
        <!-- Sidebar -->
        @include('front.layouts.sidebar')
        <!-- /Sidebar -->
        <!-- Page Content -->
        <main class="page-main">
            @include('front.layouts.slider')
            @include('front.layouts.welcome-text')
            @include('front.layouts.products')
            @include('front.layouts.banner')
            @include('front.layouts.blog')
            @include('front.layouts.social-media')
        </main>
        <!-- /Page Content -->
        <!-- Footer -->
        @include('front.layouts.foot')
        <!-- /Footer -->
        @include('front.layouts.back-to-up-element')
    </div>
    <!-- Page Content -->
</div>
<!-- ProductStack -->
{{--<div class="productStack disable hide_on_scroll"><a href="#" class="toggleStack"><i class="icon icon-cart"></i> (6)--}}
{{--        محصول</a>--}}
{{--    <div class="productstack-content">--}}
{{--        <div class="products-list-wrapper">--}}
{{--            <ul class="products-list">--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-10.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a href="#" class="action edit" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">درخواست دادن</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-11.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a class="action edit" href="#" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">درخواست دادن</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-12.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a class="action edit" href="#" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">درخواست دادن</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-13.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a class="action edit" href="#" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">Apply</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-14.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a class="action edit" href="#" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">درخواست دادن</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="product.html" title="Product Name Long Name"><img class="product-image-photo"--}}
{{--                                                                               src="images/products/product-15.jpg"--}}
{{--                                                                               alt=""></a> <span--}}
{{--                        class="item-qty">3</span>--}}
{{--                    <div class="actions"><a class="action edit" href="#" title="Edit item"><i--}}
{{--                                class="icon icon-pencil"></i></a> <a class="action delete" href="#" title="Delete item"><i--}}
{{--                                class="icon icon-trash-alt"></i></a>--}}
{{--                        <div class="edit-qty">--}}
{{--                            <input type="number" value="3">--}}
{{--                            <button type="button" class="btn">درخواست دادن</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="action-cart">--}}
{{--            <button type = "button" class = "btn" title = "Checkout"> <span> تسویه حساب </span> </button>--}}
{{--            <button type = "button" class = "btn" title = "Go to Cart"> <span> رفتن به سبد خرید </span> </button>--}}
{{--        </div>--}}
{{--        <div class="total-cart">--}}
{{--            <div class = "items-total"> موارد <span class = "count"> 6 </span> </div>--}}
{{--            <div class = "subtotal"> جمع کل <span class = "price"> 2.150 </span> </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- /ProductStack -->

<!-- Modal Quick View -->
@include('front.layouts.modals')
<!-- /Modal Quick View -->

<!-- jQuery Scripts  -->
@include('front.layouts.scripts')

</body>

</html>
