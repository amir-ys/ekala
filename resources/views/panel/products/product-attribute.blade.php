@extends('panel.layouts.master')
@section('title') ویژگی های محصول  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1')  محصول @endslot
        @slot('title')  ویژگی های محصول  @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-4">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5> نام دسته بندی : {{ $product->category->name }} </h5>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('panel.products.attribute.store' , $product->id) }}">
        <div class="row">
            @foreach($product->category->attributes as $attribute)
                <div class="col-md-3">
                    <label for="">{{ $attribute->name }}</label>
                    <input type="text" name="attribute_ids[{{ $attribute->id }}]"
                           value="{{ $product->attributes()->wherePivot('product_id'  , $product->id)
                                ->wherePivot('attribute_id' , $attribute->id)->withPivot('value')->first() ?->pivot->value  }}"
                           placeholder="{{ $attribute->name }} را وارد کنید"
                           class="form-control">
                    <x-validation-error field="attribute_ids.*"/>
                </div>
            @endforeach
        </div>
        <div class="row mt-md-4">
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    ذخیره
                </button>
                <a href="{{ route('panel.products.index') }}" class="btn btn-secondary waves-effect">
                    بازگشت
                </a>
            </div>
        </div>
    </form>
@endsection
