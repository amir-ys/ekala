@extends('panel.layouts.master')
@section('title')  محصولات   @endsection

@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  محصولات  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <a href="{{ route('panel.products.create') }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت محصول جدبد </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th> قیمت </th>
                                <th> موجودی </th>
                                <th> برند </th>
                                <th> دسته بندی </th>
                                <th> تاریخ ایجاد </th>
                                <th> وضعیت </th>
                                <th> تصاویر </th>
                                <th> ویژگی های محصول </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <span class="badge py-1 bg-{{ $product->status('cssClass') }}">{{ $product->status('name')  }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('panel.products.uploadImages.view', $product->id) }}" class="btn btn-sm bg-transparent d-inline "><i
                                            class="fas fa-pen  text-success" title="ویرایش"></i>  ویرایش </a>
                                </td>
                                <td>
                                    <a href="{{ route('panel.products.attribute.view' , $product->id) }}" class="btn btn-sm bg-transparent d-inline "><i
                                            class="fas fa-plus fa-15m text-primary" title="افزودن"></i> افزودن  </a>
                                </td>
                                <td>
                                    <a href="{{ route('panel.products.show' , $product->id) }}" class="btn btn-sm bg-transparent d-inline "><i
                                            class="fas fa-eye fa-15m text-primary"></i></a>
                                    <a class="btn btn-sm bg-transparent d-inline"
                                       href="{{ route('panel.products.edit' , $product->id) }}"><i
                                            class="fas fa-pen fa-15m text-success"></i></a>

                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="deleteItem(event , '{{ route('panel.products.destroy' , $product->id) }}')"><i
                                            class="fas fa-trash fa-15m text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                             <span>   {!! $products->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

