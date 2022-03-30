@extends('front.layouts.master')
@section('content')
    <div class="wrapper">

        <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="index.html"> صفحه ای اصلی </a>
                        </li>
                        <li class="active"> مقایسه محصول</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- compare main wrapper start -->
        <div class="compare-page-wrapper pt-100 pb-100" style="direction: rtl;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Compare Page Content Start -->
                        <div class="compare-page-content-wrap">
                            <div class="compare-table table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="first-column"> محصول</td>
                                        @foreach($products as $product)
                                        <td class="product-image-title">
                                            <a href="single-product.html" class="image">
                                                <img width="200px" class="img-fluid" src="{{ route('panel.products.displayImage' ,
                                        $product->images()->where('is_primary' , 1)->first()->files )}}"
                                                     alt="Compare Product">
                                            </a>
                                            <a href="{{ $product->category->path() }}" class="category"> {{ $product->category->name }} </a>
                                            <a href="{{ route('products.details' , $product->id) }}" class="title"> {{ $product->name }} </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column"> توضیحات</td>
                                        @foreach($products as $product)
                                        <td class="pro-desc">
                                            <p class="text-right">
                                           {{ $product->description }}
                                            </p>
                                        </td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td class="first-column"> ویژگی</td>
                                        @foreach($products as $product)

                                        <td class="pro-stock">
                                            @foreach( $product->attributes()->withPivot('value')->get() as $attribute )
                                                {{ $attribute->name  }} : {{ $attribute->value }} <br>
                                            @endforeach
                                        </td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td class="first-column"> حذف</td>
                                        @foreach($products as $product)
                                        <td class="pro-remove">
                                            <a href="{{ route('products.compare.delete' , $product->id) }}"><i class="sli sli-trash"></i></a>
                                        </td>
                                        @endforeach

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Compare Page Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- compare main wrapper end -->
    </div>
@stop
