@extends('panel.layouts.master')
@section('title') یرندها  @endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('li_1') داشبرد @endslot
        @slot('title')  برند ها @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
{{--                        <div class="col-lg-12">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12 col-lg-10">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-12 col-md-3">--}}
{{--                                            <input type="text" class="form-control mb-2" name="name" id="name"--}}
{{--                                                   placeholder="Name">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-12 col-md-4">--}}
{{--                                            <input type="text" class="form-control mb-2" name="email" id="email"--}}
{{--                                                   placeholder="Email">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-12 col-md-3">--}}
{{--                                            <input type="text" class="form-control mb-2" name="mobile" id="mobile"--}}
{{--                                                   placeholder="Mobile">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-12 col-md-2">--}}
{{--                                            <button type="submit" value="filter" name="filter" id="filter"--}}
{{--                                                    class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">--}}
{{--                                                <i class="mdi mdi-search-web me-1"></i> Filter--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-12 col-md-12 col-lg-2">--}}
{{--                                    <a href="{{ route('panel.brands.create') }}"--}}
{{--                                       class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">--}}
{{--                                        <i class="mdi mdi-plus me-1"></i>--}}
{{--                                        ساخت برند </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>نام انگلیسی</th>
                                <th> تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>{{ $brand->created_at }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $brand->statusCssClass }}">{{ $brand->statusName() }}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.brands.edit' , $brand) }}"><i
                                                class="fas fa-pen fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.brands.destroy' , $brand->id) }}"
                                           onclick="deleteItem(event , '{{ route('panel.brands.destroy' , $brand->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
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
        @include('panel.brands.create')
    </div>
    <!-- /basic responsive table -->
@endsection

