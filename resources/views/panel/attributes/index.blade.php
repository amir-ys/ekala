@extends('panel.layouts.master')
@section('title') یرندها  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') ویژگی ها  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
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
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.attributes.edit' , $attribute->id) }}"><i
                                                class="fas fa-pen fa-15m text-success"></i></a>

                                        <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                            onclick="deleteItem(event , '{{ route('panel.attributes.destroy' , $attribute->id) }}')"><i
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
        @include('panel.attributes.create')
    </div>
    <!-- /basic responsive table -->
@endsection

