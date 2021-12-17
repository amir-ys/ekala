@extends('panel.layouts.master')
@section('title') ساخت مجوز  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ساخت مجوز @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="card border border-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.permissions.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row d-flex justify-content-center">

                                <div class="col-md-12 mb-3">
                                    <label> نام فارسی</label>
                                    <input type="text" class="form-control" name="fa_name"
                                           placeholder=" نام فارسی"
                                           value="{{ old('fa_name') }}">
                                    <x-validation-error field="fa_name"/>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="نام"
                                           value="{{ old('name') }}">
                                    <x-validation-error field="name"/>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        ذخیره
                                    </button>
                                    <a href="{{ route('panel.permissions.index') }}"
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
