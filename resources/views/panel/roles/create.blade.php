@extends('panel.layouts.master')
@section('title') ساخت مجوز  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ساخت مجوز @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body border border-5">
                    <form method="POST" action="{{ route('panel.roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row d-flex justify-content-center">

                                <div class="col-md-12 mb-3">
                                    <label> نام فارسی</label>
                                    <input type="text" class="form-control" name="fa_name"
                                           placeholder=" نام فارسی"
                                           value="{{ old('fa_name') }}"
                                    >
                                    <x-validation-error field="fa_name"/>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="نام"
                                           value="{{ old('name') }}">
                                    <x-validation-error field="name"/>
                                </div>
                                <hr>
                                <h5> انتخاب مجوز ها ی این نقش :  </h5>
                                <div class="card">
                                    <div class="card-body border border-dark">
                                        <div class="col-md-12 mb-3">
                                            <div class="row">
                                                @foreach($permissions as $permission)
                                                    <div class="col-md-4">
                                                        <label>{{ $permission->fa_name }}</label>
                                                        <input type="checkbox" class="form-check-warning"
                                                               name="permissions[{{ $permission->name }}]" value="{{ $permission->id }}"
                                                               @if(is_array(old('permissions')) && array_key_exists($permission->name , old('permissions')) ) checked @endif >
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        ذخیره
                                    </button>
                                    <a href="{{ route('panel.roles.index') }}"
                                       class="btn btn-secondary waves-effect">
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
    <!-- /basic responsive table -->
@endsection
