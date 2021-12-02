@extends('panel.layouts.master')
@section('title')  کاربران   @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  کاربران  @endslot
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
                                    <a href="{{ route('panel.users.create') }}"
                                       class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت کاربر </a>
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
                                <th> ایمیل </th>
                                <th> تاریخ عضویت </th>
                                <th> وضعیت تایید حساب </th>
                                <th> وضعیت </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>

                                    <td> <span  class="badge py-1 bg-@php if (is_null($user->email_verified_at)){ echo 'danger' ; }  else{ echo 'success' ; } @endphp">
                                            @if(is_null($user->email_verified_at))
                                                تایید نشده
                                                @else
                                                تایید شده
                                                @endif
                                        </span>
                                    </td>
                                    <td> <span  class="badge py-1 bg-{{ $user->statusCssClass }}">
                                           {{  $user->statusName() }}
                                        </span>
                                    </td>
{{--                                    <td>--}}
{{--                                        <span--}}
{{--                                            class="badge py-1 bg-{{ $user->statusCssClass }}">{{ $user->statusName() }}</span>--}}
{{--                                    </td>--}}
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                          onclick="deleteItem(event , '{{ route('panel.users.destroy' , $user->id) }}')"><i
                                                class="fas fa-pen fa-15m text-success"></i></a>

                                        <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                            onclick="deleteItem(event , '{{ route('panel.users.destroy' , $user->id) }}')"><i
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

