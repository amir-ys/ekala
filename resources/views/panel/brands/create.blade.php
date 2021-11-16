@extends('panel.layouts.master')
@section('title' , 'ساخت برند')
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1') ساخت برند @endslot
        @slot('title') برند @endslot
    @endcomponent
    <div class="row">
    </div>
    <!-- end row -->


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection
