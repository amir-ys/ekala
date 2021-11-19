@extends('panel.layouts.master')
@section('title') یرندها  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویژگی ها  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <a href="{{ route('panel.categories.create') }}"
                                       class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت دسته یندی </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th> تاریخ ایجاد</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.categories.edit' , $category->id) }}"><i
                                                class="fas fa-pen fa-15m text-success"></i></a>

                                        <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                            onclick="deleteItem(event , '{{ route('panel.categories.destroy' , $category->id) }}')"><i
                                                class="fas fa-trash fa-15m text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

