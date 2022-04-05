@extends('panel.layouts.master')
@section('title') سفارشات   @endsection

@section('content')
    @component('panel.components.breadcrumb')
        @slot('title') سفارشات  @endslot
        @slot('li_1')  داشبرد @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <a href="{{ route('panel.comments.index') }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        همه  </a>
                                    <a href="{{ route('panel.comments.index') . '?status=approved' }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        تایید شده  </a>
                                    <a href="{{ route('panel.comments.index') . '?status=not_approved' }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        تایید نشده  </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th>کاربر</th>
                                <th> ادرس کاریر </th>
                                <th> هزینه ارسال </th>
                                <th>  مبلغ پرداختی </th>
                                <th> درگاه پرداختی </th>
                                <th> وضعیت </th>
                                <th> تاریخ ایجاد </th>
                                <th> تخفیف </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->address ?? '-' }}</td>
                                <td>{{ $order->delivery_amount  }}</td>
                                <td>{{ $order->paying_amount  }}</td>
                                <td>{{ $order->payment_type  }}</td>
                                <td> {{ $order->status }}  </td>
                                <td>{{ $order->created_at  }}</td>
                                <td>{{ $order->coupon ? 'دارد' : ' ' }}</td>
                                <td>
                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="changeStatus(event , '{{ route('panel.comments.changeStatus' , $order->id) }}' , '{{ $order->id }}')">
                                        <i id="comment-status-i-{{ $order->id }}" class="fas {{ $order->is_approved ? 'fa-lock-open' : 'fa-lock' }}
                                            fa-15m {{ $order->is_approved ? 'text-success' : 'text-danger' }}"></i></a>

                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="deleteItem(event , '{{ route('panel.comments.destroy' , $order->id) }}')"><i
                                            class="fas fa-trash fa-15m text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                             <span>   {!! $orders->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
