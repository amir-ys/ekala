@extends('panel.layouts.master')
@section('title')  مجور ها    @endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script>
        $(function () {
            fillDataTable();
            function fillDataTable() {
                $('#tbl_permissions').DataTable({
                    "language": {
                        "paginate": {
                            "previous": "‹" ,
                            "next": "›"
                        }
                    } ,
                    scrollY:  false,
                    scrollX:  false,
                    "paging": true,
                    "filter": true,
                    "info": false,
                    "columnDefs": [
                        { "width": "50px", "targets": 0 },
                        { "width": "300px", "targets": 1 },
                        { "width": "300px", "targets": 2 },
                        { "width": "300px", "targets": 3 },
                        { orderable: false, targets: 4 },
                    ] ,
                    ajax: "{{ route('panel.permissions.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'fa_name', name: 'fa_name'},
                        {data: 'name', name: 'name'},
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        }]
                });
            }
        })

    </script>
@endsection
@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  مجور ها   @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card border border-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <a href="{{ route('panel.permissions.create') }}"
                                       class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت مجوز </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_permissions" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th> نام فارسی </th>
                                <th>نام</th>
                                <th> تاریخ ایجاد </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @foreach($permissions as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $user->id }}</td>--}}
{{--                                    <td>{{ $user->name }}</td>--}}
{{--                                    <td>{{ $user->email }}</td>--}}
{{--                                    <td>{{ $user->created_at }}</td>--}}

{{--                                    <td> <span  class="badge py-1 bg-@php if (is_null($user->email_verified_at)){ echo 'danger' ; }  else{ echo 'success' ; } @endphp">--}}
{{--                                            @if(is_null($user->email_verified_at))--}}
{{--                                                تایید نشده--}}
{{--                                                @else--}}
{{--                                                تایید شده--}}
{{--                                                @endif--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
{{--                                    <td> <span  class="badge py-1 bg-{{ $user->statusCssClass }}">--}}
{{--                                           {{  $user->statusName() }}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <span--}}
{{--                                            class="badge py-1 bg-{{ $user->statusCssClass }}">{{ $user->statusName() }}</span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-sm bg-transparent d-inline"--}}
{{--                                          onclick="deleteItem(event , '{{ route('panel.permissions.destroy' , $user->id) }}')"><i--}}
{{--                                                class="fas fa-pen fa-15m text-success"></i></a>--}}

{{--                                        <a  class="btn btn-sm bg-transparent d-inline delete-confirm"--}}
{{--                                            onclick="deleteItem(event , '{{ route('panel.permissions.destroy' , $user->id) }}')"><i--}}
{{--                                                class="fas fa-trash fa-15m text-danger"></i></a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

