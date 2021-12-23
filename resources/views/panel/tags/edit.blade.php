@extends('panel.layouts.master')
@section('title' , 'ویرایش برچسب')
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویرایش برچسب @endslot
        @slot('li_1') برچسب @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header">
                        <div class="alert alert-primary" role="alert">
                            ویرایش برچسب
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.tags.update' , $tag->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ old('name' , $tag->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 offset-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    بروزرسانی
                                </button>
                                <a href="{{ route('panel.tags.index') }}" class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


@endsection

