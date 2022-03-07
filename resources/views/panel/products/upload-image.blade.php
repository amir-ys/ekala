@extends('panel.layouts.master')
@section('title') بارگذاری تصاویر محصول  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1') ساخت محصول @endslot
        @slot('title')  بارگذاری تصاویر محصول  @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-4">
            <div class="card  border border-1 border-primary">
                <div class="card-header">
                    <h5> تصویر اصلی</h5>
                    <hr>
                </div>
                <div class="card-body">
                    @if(!is_null($primaryImage))

                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <img src="{{ route('panel.products.displayImage' , $primaryImage->files) }}"
                                     width="100%"
                                     alt="">
                            </div>
                            <div class="col-md-6 mt-md-2">
                                <p> عکس : {{ $primaryImage->client_file_name }} </p>
                            </div>
                            <div class="col-md-6 mt-md-2">
                                <form method="post"
                                      action="{{ route('panel.products.image.delete' , $primaryImage->id) }}"
                                      id="delete-primary">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" form="delete-primary" class="btn btn-danger"> حذف</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p> هیچ عکس اصلی انتخاب نشده است. </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border border-1 border-primary">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-12">
                            <form action="{{ route('panel.products.image.upload' , request()->product->id) }}"
                                  method="post" enctype="multipart/form-data" id="upload-primary">
                                @csrf
                                <input type="hidden" name="is_primary" value="1">
                                <label for=""> آپلود عکس جدید </label>
                                <input type="file" name="primary_image">
                                <button class="btn btn-primary btn-sm" form="upload-primary"> آپلود</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header border border-5 d-inline">
                <h5 class="mb-md-2">
                    دیگر تصاویر محصول
                </h5>
                <form action="{{ route('panel.products.image.deleteAll' , request()->product->id )  }}"
                      method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger"> حذف تمام تصاوبر</button>
                </form>
            </div>
        </div>
        @if(!is_null($images->first()))
            @foreach($images as $image)
                <div class="col-md-3">
                    <div class="card  border border-1 border-primary">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <img src="{{ route('panel.products.displayImage' , $image->files) }}" width="100%"
                                         alt="">
                                </div>
                                <div class="col-md-6 mt-md-2">
                                    <p> عکس : {{ $image->client_file_name }} </p>
                                </div>
                                <div class="col-md-6 mt-md-2">
                                    <form method="post" action="{{ route('panel.products.image.delete' , $image->id) }}"
                                          id="delete-images">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" form="delete-images" class="btn btn-danger"> حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="card  border border-1 border-primary">
                    <div class="card-body">
                        <p> هیچ عکس دیگری برای این محصول انتخاب نشده است. </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-3">
            <div class="card border border-1 border-primary">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-12">
                            <form action="{{ route('panel.products.image.upload' , request()->product->id) }}"
                                  method="post" enctype="multipart/form-data" id="upload-images">
                                @csrf
                                <input type="hidden" name="is_primary" value="0">
                                <label> آپلود عکس جدید </label>
                                <input type="file" name="images[]" multiple>
                                <button class="btn btn-primary btn-sm" form="upload-images"> آپلود</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
