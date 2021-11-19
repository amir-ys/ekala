@extends('panel.layouts.master')
@section('title') ویرایش دسته بندی  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
        $("#attribute-select").on("select2:select", function (e) {
            //is filter field and is variation field
            var select_val = $(e.currentTarget).val();
            var attributes = @json($attributes);
            var attribute_filter = [];
            attributes.map(function (attribute) {
                $.each(select_val, function (i, element) {
                    if (attribute.id == element) {
                        attribute_filter.push(attribute)
                    }
                })
            })
            $('#attribute-filter-select').find('option').remove()
            $('#attribute-variation-select').find('option').remove()
            attribute_filter.forEach(function (element) {
                var attributeFilterElement = $('<option/>', {
                    value: element.id,
                    text: element.name,
                })

                var attributeVariationElement = $('<option/>', {
                    value: element.id,
                    text: element.name,
                })

                $('#attribute-filter-select').append(attributeFilterElement)
                $('#attribute-variation-select').append(attributeVariationElement)
            })
        });
        $("#attribute-select").on("select2:unselect", function (e) {
            var select_val = $(e.currentTarget).val();
            $('#attribute-filter-select').find('option').remove()
            $('#attribute-variation-select').find('option').remove()
        })

        $('#attribute-select').select2({
            placeholder: "انتخاب ویژگی"
        })

        $('#attribute-filter-select').select2({
            placeholder: "انتخاب ویژگی قابل قبلتر"
        })

        $('#attribute-variation-select').select2({
            placeholder: "انتخاب ویژگی متغییر"
        })


    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش دسته بندی  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.categories.update' , $category->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name' , $category->name) }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>نام انگلیسی</label>
                                        <input type="text" class="form-control" name="slug"
                                               placeholder="نام انگلیسی"
                                               value="{{ old('slug' ,$category->slug) }}">
                                        <x-validation-error field="slug"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>والد</label>
                                        <select class="form-control" name="parent_id">
                                            <option value> بدون والد</option>
                                            @foreach($parentCategories as $parentCategory)
                                                <option value="{{ $parentCategory->id }}"
                                                        @if($parentCategory->id == $category->parent_id) selected @endif >
                                                    {{ $parentCategory->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status">
                                            @foreach(\App\Models\Category::$statuses as $statusName => $status)
                                                <option value="{{ $status }}"
                                                        @if($status == $category->status ) selected @endif
                                                > {{ $statusName }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>ویژگی</label>
                                        <select class="select2 select2-search form-control select2-multiple" multiple
                                                id="attribute-select" name="attribute_ids[]">
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}"
                                                        @if( in_array($attribute->id  , $category->attributes()->pluck('id')->toArray())) selected @endif
                                                > {{ $attribute->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="attribute_ids"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label> انتخاب ویژگی های قابل فیلتر</label>
                                        <select class="select2 form-control select2-multiple" multiple
                                                id="attribute-filter-select" name="attribute_filter_ids[]">
                                            @foreach($category->attributes()->wherePivot('is_filter' , 1)->get() as $filterableAttribute)
                                                <option value="{{ $filterableAttribute->id }}" selected> {{ $filterableAttribute->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="attribute_filter_ids"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>انتخاب ویژگی های متغیر</label>
                                        <select class="select2 form-control select2-multiple" multiple
                                                id="attribute-variation-select" name="attribute_variation_id">
                                            @foreach($category->attributes()->wherePivot('is_variation' , 1)->get() as $variationAttribute)
                                                <option value="{{ $variationAttribute->id }}" selected> {{ $variationAttribute->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="attribute_variation_id"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>آیکون </label>
                                        <input type="text" class="form-control" name="icon"
                                               placeholder="آیکون"
                                               value="{{ old('icon') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>توضیحات</label>
                                        <textarea class="form-control"
                                                  name="description"> {{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="{{ route('panel.categories.index') }}" class="btn btn-secondary waves-effect">
                                    لغو
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
