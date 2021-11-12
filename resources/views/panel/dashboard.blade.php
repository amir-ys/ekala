@extends('panel.layouts.master')
@section('title' , 'Dashboard')
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Dashboard @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-12">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>Skote Dashboard</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img
{{--                                    {{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}--}}
                                    src=""
                                    alt="" class="img-thumbnail rounded-circle">
                            </div>
{{--                            <h5 class="font-size-15 text-truncate">{{ Str::ucfirst(Auth::user()->name) }}</h5>--}}
                            <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">
                            </div>
                        </div>
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

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
