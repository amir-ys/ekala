@extends('panel.layouts.master')
@section('title')  نقش های کاریری    @endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script>
        $(function () {
            fillDataTable();
            function fillDataTable() {
                $('#tbl_roles').DataTable({
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
                        { "width": "200px", "targets": 1 },
                        { "width": "200px", "targets": 2 },
                        { "width": "250px", "targets": 3 },
                        { "width": "250px", "targets": 4 },
                        { orderable: false, targets: 5 },
                    ] ,
                    ajax: "{{ route('panel.roles.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'fa_name', name: 'fa_name'},
                        {data: 'name', name: 'name'},
                        {data: 'permissions', name: 'permissions'},
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
        @slot('title')  نقش های کاریری   @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <a href="{{ route('panel.roles.create') }}"
                                       class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 w-100">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت نقش کاریری جدید</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_roles" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th> نام فارسی </th>
                                <th>نام</th>
                                <th> مجوزها </th>
                                <th> تاریخ ایجاد </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

