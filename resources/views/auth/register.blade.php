@extends('front.layouts.master')
@section('content')
    <div class="login-register-area pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a data-toggle="tab" href="#lg1">
                                <h4> ورود </h4>
                            </a>
                            <a class="active" data-toggle="" href="#lg2">
                                <h4> عضویت </h4>
                            </a>
                        </div>
                        <div class="tab-content">

                            <div id="lg1" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="#" method="post">
                                            <input type="text" name="user-name" placeholder="ایمیل">
                                            <input type="password" name="user-password" placeholder="رمز عبور">
                                            <div class="button-box">
                                                <div class="login-toggle-btn d-flex justify-content-between">
                                                    <div>
                                                        <input type="checkbox">
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

                            <div id="lg2" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('register') }}" method="post">
                                            @csrf
                                            <div>
                                                <input name="name" class="@error('name') mb-1 @enderror" placeholder="نام"
                                                       type="text" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="input-error-validation ">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>

                                            <div>
                                            <input name="email" class="@error('email') mb-1 @enderror" placeholder="ایمیل"
                                                   type="email" value="{{ old('email') }}">
                                                @error('email')
                                                <div class="input-error-validation ">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>

                                            <div>
                                                <input type="password" class="@error('email') mb-1 @enderror" name="password" placeholder="رمز عبور">
                                                <input type="password" class="@error('email') mb-1 @enderror" name="password_confirmation" placeholder="تکرار رمز عبور">
                                                @error('password')
                                                <div class="input-error-validation ">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>
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
