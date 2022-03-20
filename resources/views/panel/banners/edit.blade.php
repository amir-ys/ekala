@extends('panel.layouts.master')
@section('title') وبرابش بنرها  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش بنر @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.banners.update' , $banner->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>عنوان</label>
                                        <input type="text" class="form-control" name="title"
                                               placeholder="عنوان"
                                               value="{{ old('title' , $banner->title) }}">
                                        <x-validation-error field="title"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>اولویت</label>
                                        <input type="number" class="form-control" name="priority"
                                               placeholder="اولویت"
                                               value="{{ old('priority' , $banner->priority) }}">
                                        <x-validation-error field="priority"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status" >
                                            <option value>وضعیت را انتخاب کنید</option>
                                            @foreach(\App\Models\Banner::$statuses as $statusName =>  $status)
                                                <option value="{{ $status }}"
                                                @if($status == $banner->status) selected @endif > {{ $statusName }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>نوع</label>
                                        <select name="type" class="form-control" id="banner-type">
                                            <option value> نوع بنر را انتخاب کنید</option>
                                            @foreach(\App\Models\Banner::$types as $type)
                                                <option value="{{ $type }}"
                                                @if($banner->type == $type) selected @endif
                                                > {{ $type }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="type"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>لینک بنر</label>
                                        <input type="text" class="form-control" name="btn_link"
                                               placeholder="لینک بنر"
                                               value="{{ old('btn_link' , $banner->btn_link) }}">
                                        <x-validation-error field="btn_link"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> متن دکمه</label>
                                        <input type="text" class="form-control" name="btn_text"
                                               placeholder="متن دکمه"
                                               value="{{ old('btn_text' , $banner->btn_text) }}">
                                        <x-validation-error field="btn_text"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> آیکون دکمه</label>
                                        <input type="text" class="form-control" name="btn_icon"
                                               placeholder="آیکون دکمه"
                                               value="{{ old('btn_icon' , $banner->btn_icon) }}">
                                        <x-validation-error field="btn_icon"/>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>عنوان</label>
                                        <textarea  class="form-control" name="body"
                                                   placeholder="توضیحات">  {{ old('body' , $banner->body) }}
                                        </textarea>
                                        <x-validation-error field="body"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>عکس  بنر</label>

                                <input type="file" class="form-control" name="image"
                                           placeholder="عکس بنر"
                                           value="{{ old('image') }}">
                                <x-validation-error field="image"/>
                                @if(isset($banner->image))
                                    <label>عکس فعلی:  {{ $banner->image->client_file_name }}</label>

                                    <img src="{{ route('panel.products.displayImage' , $banner->image->files) }}" width="300" alt="">
                                @endif
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="{{ route('panel.banners.index') }}" class="btn btn-secondary waves-effect">
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
