@extends('panel.layouts.master')
@section('title') ساخت محصول  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        $('#tag-select2').select2({
            placeholder: "انتخاب تگ",
        })
        ClassicEditor.create( document.querySelector( '#ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ساخت محصول @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>قیمت</label>
                                        <input type="text" class="form-control" name="price"
                                               placeholder="قیمت"
                                               value="{{ old('price') }}">
                                        <x-validation-error field="price"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>موجودی</label>
                                        <input type="text" class="form-control" name="quantity"
                                               placeholder="موجودی"
                                               value="{{ old('quantity') }}">
                                        <x-validation-error field="quantity"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>برند</label>
                                        <select class="form-control" name="brand_id">
                                            <option value>  انتخاب  برند </option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                        @if($brand->id == old('brand_id')) selected @endif>
                                                    {{ $brand->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="brand_id"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status">
                                            @foreach(\App\Models\Product::$statuses as $brandName => $brand)
                                                <option value="{{ $brand }}"
                                                        @if($brand == old('status')) selected @endif
                                                > {{ $brandName }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>دسته بندی ها</label>
                                        <select class="form-control"  name="category_id">
                                            <option value>  انتخاب  دسته بندی </option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($category->id == old('category_id')) selected @endif
                                                >{{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="category_id"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>تگ ها</label>
                                        <select class="form-control select2" id="tag-select2" multiple name="tag_ids[]">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                  @if( is_array(old('tag_ids')) && in_array($tag->id ,  old('tag_ids'))) selected @endif
                                                > {{ $tag->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="tag_id"/>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3" >
                                        <label>توضیحات</label>
                                        <textarea id="ckeditor" class="form-control" name="description"> {{ old('description') }}</textarea>
                                    <x-validation-error field="description"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <p> انتخاب تصاویر محصول : </p>
                                    <div class="col-md-4 mb-3">
                                        <label>انتخاب تصویر اصلی</label>
                                        <input type="file" class="form-control" name="primary_image" />
                                        <x-validation-error field="primary_image"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>انتخاب تصاوبر دیگر</label>
                                        <input type="file" multiple class="form-control" name="images[]" />
                                        <x-validation-error field="images"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label> هزینه ارسال </label>
                                        <input type="text" class="form-control" name="delivery_amount"
                                               placeholder="هزینه ارسال"
                                               value="{{ old('delivery_amount') }}">
                                        <x-validation-error field="delivery_amount"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label> هزینه ارسال برای این محصول</label>
                                        <input type="text" class="form-control" name="delivery_amount_per_product"
                                               placeholder="هزینه ارسال برای این محصول"
                                               value="{{ old('delivery_amount_per_product') }}">
                                        <x-validation-error field="delivery_amount_per_product"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="{{ route('panel.products.index') }}" class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
