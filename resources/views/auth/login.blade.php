@extends('front.layouts.master')
@section('content')
    <div class="login-register-area pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> ورود </h4>
                            </a>
                            <a data-toggle="tab" href="#lg2">
                                <h4> عضویت </h4>
                            </a>
                        </div>
                        <div class="tab-content">

                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div>
                                                <input name="email" class="@error('email') mb-1 @enderror" placeholder="ایمیل"
                                                       type="email" value="{{ old('email') }}">

                                            </div>

                                            <div>
                                                <input type="password" class="@error('email') mb-1 @enderror" name="password" placeholder="رمز عبور">
                                                @error('password')
                                                <div class="input-error-validation ">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                                @error('email')
                                                <div class="input-error-validation ">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn d-flex justify-content-between">
                                                    <div>
                                                        <input name="remember" type="checkbox" @if(old('remember')) checked @endif>
                                                        <label> مرا بخاطر بسپار </label>
                                                    </div>
                                                    <a href="register.html"> فراموشی رمز عبور ! </a>
                                                </div>
                                                <button type="submit">ورود</button>
                                                <a href="index.html" class="btn btn-google btn-block mt-4">
                                                    <i class="sli sli-social-google"></i> ورود با حساب گوگل
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="#" method="post">
                                            <input name="name" placeholder="نام" type="email">
                                            <input name="user-email" placeholder="ایمیل" type="email">
                                            <input type="password" name="user-password" placeholder="رمز عبور">
                                            <input type="text" name="user-name" placeholder="تکرار رمز عبور">
                                            <div class="button-box">
                                                <button type="submit">عضویت</button>
                                                <a href="index.html" class="btn btn-google btn-block mt-4">
                                                    <i class="sli sli-social-google"></i>
                                                    ایجاد اکانت با گوگل
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
