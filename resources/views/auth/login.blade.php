@extends('front.layouts.master')
@section('content')
    <div STYLE="height: 100px" ></div>
        <div class="block">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="index-rtl.html"><i class="icon icon-home"></i></a></li>
                    <li>/<span>صفحه ورود</span></li>
                </ul>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row row-eq-height">
                    <div class="col-sm-6">
                        <div class="form-card">
                            <h4> مشتریان جدید </h4>
                            <p> با ایجاد یک حساب کاربری در فروشگاه ما ، شما می توانید از طریق پرداخت خارج شوید
                                سریعتر پردازش کنید ، چندین آدرس حمل و نقل را ذخیره کنید ، سفارشات خود را مشاهده و پیگیری کنید
                                حساب شما و موارد دیگر. </p>
                            <div> <a href="account-create.html" class="btn btn-lg"> <i
                                        class = "icon icon-user"> </i> <span> <a href="{{ route('register') }}">ایجاد یک حساب کاربری</a> </span> </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-card">
                            <h2> مشتریان ثبت شده </h2>
                            <p> اگر با ما حساب کاربری دارید ، لطفاً وارد شوید. </p>
                            <form class="account-create" method="post" action="{{ route('login') }}">
                                @csrf
                                <label> پست الکترونیکی <span class = "required"> * </span> </label>
                                <input name="email" type = "text" class = "form-control input-lg">
                                <label> گذرواژه <span class = "required"> * </span> </label>
                                <input name="password" type = "password" class = "form-control input-lg">
                                <x-validation-error field="email"/>
                                <x-validation-error field="password"/>
                                <div>
                                    <button class = "btn btn-lg"> ورود </button>

                                    <div class = "back"> <a href="#"> رمز ورود خود را فراموش کرده اید؟ </a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
