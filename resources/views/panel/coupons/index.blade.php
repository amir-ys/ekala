@extends('panel.layouts.master')
@section('title')  تخفیف ها   @endsection

@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  تخفیف ها  @endslot
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
                                    <a href="{{ route('panel.coupons.create') }}"
                                       class="btn btn-primary text-white rounded-2xl waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i>
                                        ساخت تخفیف جدبد </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>شناسه</th>
                                <th> نام </th>
                                <th> کد </th>
                                <th> نوع </th>
                                <th> مقدار </th>
                                <th> تاریخ اعتبار </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>{{  $loop->iteration  }}</td>
                                <td>{{ $coupon->name  }}</td>
                                <td>{{ $coupon->code  }}</td>
                                <td> @lang($coupon->type)   </td>
                                @if($coupon->type == \App\Models\Coupon::TYPE_AMOUNT )
                                    <td>{{ number_format($coupon->amount ) }}</td>
                                @else
                                    <td>{{ '%' . $coupon->percent }}</td>
                                @endif
                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($coupon->expired_at)->format('Y-m-d h:i') }}</td>
                                <td>
                                    <a class="btn btn-sm bg-transparent d-inline"
                                       href="{{ route('panel.coupons.edit' , $coupon->id) }}"><i
                                            class="fas fa-pen fa-15m text-success"></i></a>

                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="deleteItem(event , '{{ route('panel.coupons.destroy' , $coupon->id) }}')"><i
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

