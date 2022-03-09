@extends('panel.layouts.master')
@section('title')  بنر ها   @endsection

@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  بنر ها  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <a href="{{ route('panel.banners.create') }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت بنر جدبد </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th>عکس</th>
                                <th> عنوان </th>
                                <th> توضیحات </th>
                                <th> وضعیت </th>
                                <th> نوع  </th>
                                <th> تاریخ ایجاد </th>
                                <th> ادرس  </th>
                                <th> متن دکمه  </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($banners as $banner)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> aks </td>
                                <td>{{  $banner->title  }}</td>
                                <td>{{ $banner->body }}</td>
                                <td>{{ $banner->statusName  }}</td>
                                <td>{{ $banner->type }}</td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->btn_link }}</td>
                                <td>{{ $banner->btn_text }}</td>
                                <td>
                                    <a href="{{ route('panel.banners.show' , $banner->id) }}" class="btn btn-sm bg-transparent d-inline "><i
                                            class="fas fa-eye fa-15m text-primary"></i></a>
                                    <a class="btn btn-sm bg-transparent d-inline"
                                       href="{{ route('panel.banners.edit' , $banner->id) }}"><i
                                            class="fas fa-pen fa-15m text-success"></i></a>

                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="deleteItem(event , '{{ route('panel.banners.destroy' , $banner->id) }}')"><i
                                            class="fas fa-trash fa-15m text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                             <span>   {!! $banners->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

