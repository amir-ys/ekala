@extends('panel.layouts.master')
@section('title') ساخت کد تخفیف  @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/mds.bs.datetimepicker.style.css" rel="stylesheet"/>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="/assets/js/mds.bs.datetimepicker.js"></script>
    <script>
        const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById('expired_at_input'), {
            targetTextSelector: '#expired_at_input',
            placement : 'top' ,
            englishNumber : true ,
            enableTimePicker : true ,
            textFormat : "yyyy-MM-dd HH:mm" +
                "" ,
        });
    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ساخت کد تخفیف جدید @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.coupons.store') }}" >
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>کد</label>
                                        <input type="text" class="form-control" name="code"
                                               placeholder="کد"
                                               value="{{ old('code') }}">
                                        <x-validation-error field="code"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>نوع</label>
                                        <select class="form-control" name="type" >
                                            <option value>نوع تخفیف را انتخاب کنید</option>
                                            @foreach(\App\Models\Coupon::$types as $typeName =>  $type)
                                            <option value="{{ $type }}"
                                                @if($type == old('type')) selected @endif
                                            >{{ $typeName }}
                                                ></option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="type"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label> مبلغ </label>
                                        <input type="number" class="form-control" name="amount"
                                               placeholder="مبلغ"
                                               value="{{ old('amount') }}">
                                        <x-validation-error field="amount"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>  درصد </label>
                                        <input type="number" class="form-control" name="percent"
                                               placeholder=" درصد"
                                               value="{{ old('percent') }}">
                                        <x-validation-error field="percent"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>  درصد </label>
                                        <input type="text" id="expired_at_input" class="form-control" name="expired_at"
                                               placeholder=" تاریخ انقضا"
                                               value="{{ old('expired_at') }}">
                                        <x-validation-error field="expired_at"/>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="{{ route('panel.coupons.index') }}" class="btn btn-secondary waves-effect">
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

