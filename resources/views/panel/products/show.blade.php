@extends('panel.layouts.master')
@section('title') نمایش محصول  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
        $('#tag-select2').select2({
            placeholder: "انتخاب تگ",
        })

    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') نمایش محصول @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input disabled type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name' ,  $product->name) }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>قیمت</label>
                                        <input disabled type="text" class="form-control" name="price"
                                               placeholder="قیمت"
                                               value="{{ old('price' , $product->price) }}">
                                        <x-validation-error field="price"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>موجودی</label>
                                        <input disabled type="text" class="form-control" name="quantity"
                                               placeholder="موجودی"
                                               value="{{ old('quantity' , $product->quantity) }}">
                                        <x-validation-error field="quantity"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>برند</label>
                                        <select class="form-control" disabled name="brand_id">
                                            <option value>  انتخاب  برند </option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                        @if($brand->id == $product->brand_id) selected
                                                        @elseif($brand->id == old('brand_id')) selected @endif>
                                                    {{ $brand->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="brand_id"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" disabled name="status">
                                            @foreach(\App\Models\Product::$statuses as $statusName => $status)
                                                <option value="{{ $status }}"
                                                        @if($status == $product->status) selected @endif>
                                                    {{ $statusName }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>دسته بندی ها</label>
                                        <select class="form-control" disabled  name="category_id">
                                            <option value>  انتخاب  دسته بندی </option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($category->id == $product->category_id) selected @endif
                                                        @if($category->id == old('category_id')) selected @endif
                                                >{{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="category_id"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>تگ ها</label>
                                        <select class="form-control select2" disabled multiple name="tag_ids[]" id="tag-select2">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                        @if($product->tags->contains($tag->id)) selected @endif
                                                > {{ $tag->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="tag_id.*"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>توضیحات</label>
                                        <textarea disabled rows="5" class="form-control" name="description"> {{ old('description' , $product->description) }}</textarea>
                                        <x-validation-error field="description"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label> هزینه ارسال </label>
                                        <input disabled type="text" class="form-control" name="delivery_amount"
                                               placeholder="هزینه ارسال"
                                               value="{{ old('delivery_amount' , $product->delivery_amount) }}">
                                        <x-validation-error field="delivery_amount"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label> هزینه ارسال برای این محصول</label>
                                        <input disabled type="text" class="form-control" name="delivery_amount_per_product"
                                               placeholder="هزینه ارسال برای این محصول"
                                               value="{{ old('delivery_amount_per_product' , $product->delivery_amount_per_product) }}">
                                        <x-validation-error field="delivery_amount_per_product"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-2">
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
