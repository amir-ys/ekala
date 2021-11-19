@extends('panel.layouts.master')
@section('title') ویرایش دسته بندی  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" disabled class="form-control" value="{{  $category->name }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>نام انگلیسی</label>
                                        <input type="text" disabled class="form-control" value="{{  $category->slug }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>والد</label>
                                        <input type="text" disabled class="form-control" value="{{ !$category->parent ? 'بدون والد ' :  $category->parent->name  }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <input type="text" disabled class="form-control" value="{{  $category->statusName($category->status) }}">
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label>ویژگی</label>
                                    @php $attributeList = null @endphp
                                    @foreach($category->attributes as $attribute)
                                        @php $attributeList .= $attribute->name .  ' , '   @endphp
                                    @endforeach
                                        <input type="text" disabled class="form-control"
                                               value="{{ $attributeList  }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label> انتخاب ویژگی های قابل فیلتر</label>
                                    @php $filterAttribute = null @endphp
                                    @foreach($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                                        @php $filterAttribute .= $attribute->name .  ' , '   @endphp
                                    @endforeach
                                    <input type="text" disabled class="form-control"
                                           value="{{ $filterAttribute  }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>انتخاب ویژگی های متغیر</label>
                                    @php $variationAttribute = null @endphp
                                    @foreach($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                                        @php $variationAttribute .= $attribute->name .  ' , '   @endphp
                                    @endforeach
                                    <input type="text" disabled class="form-control"
                                           value="{{ $variationAttribute  }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>آیکون </label>
                                    <input type="text" disabled class="form-control"
                                           value="{{ $category->icon }}">
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>توضیحات</label>
                                        <textarea disabled class="form-control"
                                                  name="description"> {{ $category->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('panel.categories.index') }}" class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
