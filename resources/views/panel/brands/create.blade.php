@extends('panel.layouts.master')
@section('title' , 'ساخت برند')
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1') ساخت برند @endslot
        @slot('title') برند @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-12">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.brands.index') }}" >
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control " name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback" >
                                        <strong> {{ $message }} </strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">وضعیت</label>
                                    <select class="form-control" name="status" aria-hidden="true">
                                        <option value > وضعیت برند </option>
                                        @foreach(\App\Models\Brand::$statuses as $status)
                                        <option value="{{ $status }}">  {{ \App\Models\Brand::statusName($status) }}  </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback" >
                                        <strong> {{ $message }} </strong>
                                    </div>
                                    @enderror
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
    <!-- end row -->


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection
