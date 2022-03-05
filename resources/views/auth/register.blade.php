@extends('front.layouts.master')
@section('content')
    <div class="block">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="index.html"><i class="icon icon-home"></i></a></li>
                <li>/<span>Faq</span></li>
            </ul>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="form-card">
                <h3>اطلاعات شخصی</h3>
                <form style="direction: rtl" class="account-create" action="{{ route('register') }}" method="post">
                    @csrf
                    <label>نام<span class="required">*</span></label>
                    <input name="name" type="text" class="form-control input-lg" value="{{ old('name') }}" >
                    <x-validation-error field="name" />
                    <label>ایمیل<span class="required">*</span></label>
                    <input name="email" type="text" class="form-control input-lg" value="{{ old('email') }}">
                    <x-validation-error field="email" />
                    <label>پسورد<span class="required">*</span></label>
                    <input name="password" type="password" class="form-control input-lg">
                    <label> تایید پسورد<span class="required">*</span></label>
                    <input name="password_confirmation" type="password" class="form-control input-lg">
                    <x-validation-error field="password" />
                    <div>
                        <button class="btn btn-lg">ایجاد کردن</button>
                        <div class="back"> <a href="#">بازگشت به فروشگاه<i class="icon icon-undo"></i></a></div>
                </form>
            </div>
        </div>
    </div>
@endsection
