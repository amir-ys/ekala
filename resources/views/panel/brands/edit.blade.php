@extends('panel.layouts.master')
@section('title' , 'ویرایش  برند')
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش برند @endslot
        @slot('li_1') برند @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <div class="alert alert-primary" role="alert">
                            ویرایش برند
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.brands.update' , $brand->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ old('name' , $brand->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">وضعیت</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="status" aria-hidden="true">
                                                    <option value> وضعیت برند</option>
                                                    @foreach(\App\Models\Brand::$statuses as $status)
                                                        <option
                                                            value="{{ $status }}"
                                                        @if($status == $brand->status) selected @endif
                                                        >  {{ \App\Models\Brand::statusName($status) }}  </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 offset-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    بروزرسانی
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection