@extends('panel.layouts.master')
@section('title') ساخت کاربر  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ساخت دسته بندی @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.users.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>ایمیل</label>
                                        <input type="text" class="form-control" name="email"
                                               placeholder="ایمیل"
                                               value="{{ old('email') }}">
                                        <x-validation-error field="email"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> کلمه عبور </label>
                                        <input type="text" class="form-control" name="password"
                                               placeholder="کلمه عبور "
                                               value="{{ old('password') }}">
                                        <x-validation-error field="password"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> وضعیت تایید ایمیل </label>
                                        <input type="checkbox"  class="form-check"  name="email_verified_at"
                                               value="1">
                                    </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ذخیره
                                </button>
                                <a href="{{ route('panel.users.index') }}" class="btn btn-secondary waves-effect">
                                    لغو
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
