@extends('panel.layouts.master')
@section('title') ویرایش مجوز  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش مجوز @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <form method="POST" action="{{ route('panel.permissions.update' , $permission->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>نام انگلسیسی</label>
                                        <input type="text" class="form-control" name="fa_name"
                                               placeholder="نام انگلسیسی"
                                               value="{{ old('fa_name' , $permission->fa_name) }}">
                                        <x-validation-error field="fa_name"/>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>نام</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام"
                                               value="{{ old('name'  , $permission->name) }}">
                                        <x-validation-error field="name"/>
                                    </div>


                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            ذخیره
                                        </button>
                                        <a href="{{ route('panel.permissions.index') }}" class="btn btn-secondary waves-effect">
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
