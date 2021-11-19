@extends('panel.layouts.master')
@section('title') دسته بندی ها   @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') دسته بندی ها  @endslot
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
                                        ساخت دسته بندی </a>
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
                                <th>دسته پدر</th>
                                <th> تاریخ ایجاد</th>
                                <th> وضعیت </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent  ? $category->parent->name : 'ندارد'  }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $category->statusCssClass }}">{{ $category->statusName() }}</span>
                                    </td>
                                    <td>
                                         <a href="{{ route('panel.categories.show' , $category->id) }}" class="btn btn-sm bg-transparent d-inline "><i
                                                  class="fas fa-eye fa-15m text-primary"></i></a>
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

