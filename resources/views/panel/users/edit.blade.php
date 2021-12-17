@extends('panel.layouts.master')
@section('title') ویرایش کاربر  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش کاربر  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.users.update' , $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name'  , $user->name) }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>ایمیل</label>
                                        <input type="text" class="form-control" name="email"
                                               placeholder="ایمیل"
                                               value="{{ old('email' , $user->email) }}">
                                        <x-validation-error field="email"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> کلمه عبور جدید</label>
                                        <input type="text" class="form-control" name="password"
                                               placeholder="کلمه عبور جدید"
                                               >
                                        <x-validation-error field="password"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> وضعیت تایید ایمیل </label>
                                        <input type="checkbox"  class="form-check" @if(!is_null($user->email_verified_at)) checked @endif name="email_verified_at"
                                               value="1">
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            ذخیره
                                        </button>
                                        <a href="{{ route('panel.users.index') }}" class="btn btn-secondary waves-effect">
                                            بازگشت
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
