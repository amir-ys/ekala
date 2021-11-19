@extends('panel.layouts.master')
@section('title') یرندها  @endsection
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
    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویژگی ها  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.categories.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>نام انگلیسی</label>
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                        <x-validation-error field="slug"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>والد</label>
                                        <select class="form-control" name="parent_id">
                                            <option value="0">  یدون والد</option>
                                            @foreach($parentCategories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($category->id == old('parent_id')) selected @endif
                                                > {{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status">
                                            @foreach(\App\Models\Category::$statuses as $categoryName => $category)
                                                <option value="{{ $category }}"
                                                        @if($category == old('status')) selected @endif
                                                > {{ $categoryName }} </option>
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
                                                <option value="{{ $attribute->id }}"> {{ $attribute->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="attribute_ids"/>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label> انتخاب ویژگی های قابل فیلتر</label>
                                        <select class="select2 form-control select2-multiple" multiple
                                                id="attribute-filter-select" name="attribute_filter_ids[]">
                                        </select>
                                        <x-validation-error field="attribute_filter_ids"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>انتخاب ویژگی های متغییر</label>
                                        <select class="select2 form-control select2-multiple" multiple
                                                id="attribute-variation-select" name="attribute_variation_ids[]">
                                        </select>
                                        <x-validation-error field="attribute_variation_ids"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>آیکون </label>
                                        <input type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>توضیحات</label>
                                        <textarea class="form-control" name="description"> {{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="" class="btn btn-secondary waves-effect">
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
