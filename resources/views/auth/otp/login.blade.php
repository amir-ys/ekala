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


                                        <form id="mobile-form">
                                            <input type="text" id="mobile-inpute" name="mobile" placeholder="شماره موبایل" autofocus autocomplete="on">
                                            <div class="invalid-feedback text-right" id="mobile-input-div" >
                                                <strong id="mobile-input-text" style="color: #c93434"> </strong>
                                            </div>
                                            <div class="button-box">
                                                <button type="submit">ارسال</button>
                                            </div>
                                        </form>



                                            <form id="otp-form">
                                                <input type="text" id="otp-code-input" name="mobile" placeholder="کد ارسال شده را وارد کنید " autofocus>
                                                <div class="invalid-feedback text-right" id="otp-input-div" >
                                                    <strong id="otp-input-text" style="color: #c93434"> </strong>
                                                </div>
                                               <div >
                                                   <div class="button-box btn-sm text-left">
                                                       <button id="resend-btn" type="submit">ارسال مجدد</button>
                                                       <span id="timer">n</span>

                                                   </div>
                                                   <div class="button-box">
                                                       <button type="submit">ورود</button>
                                                   </div>
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

@section('script')
    <script>

       $('#otp-form').hide();
       let login_token;
       $('#mobile-form').submit(function () {
           event.preventDefault();
           var mobile  = $('#mobile-inpute').val();
           $.post(`{{ route('otp.login') }}` , { _token : "{{ csrf_token() }}" , mobile : mobile })
               .done(function (response){
                   $('#mobile-input-text').html('');
                   $('#mobile-form').hide();
                   $('#otp-form').fadeIn();
                   login_token = response.login_token;
               })
               .fail(function (response) {
                   $('#mobile-input-div').addClass('d-block');
                   $('#mobile-input-text').html(response.responseJSON.errors.mobile[0]);
               })
       })

       $('#otp-form').submit(function (){
           event.preventDefault();
           var otp  = $('#otp-code-input').val();
           $.post(`{{ route('otp.check') }}` , { _token : "{{ csrf_token() }}" , login_token : login_token , otp : otp })
           .done(function (response) {
               location.href= "{{ route('home') }}"
           })

           .fail(function (response) {
               console.log(response.responseJSON.errors.otp[0])
               $('#otp-input-div').addClass('d-block');
               $('#otp-input-text').html(response.responseJSON.errors.otp[0]);
           })


       })
    </script>
@endsection
