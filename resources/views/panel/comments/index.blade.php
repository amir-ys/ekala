@extends('panel.layouts.master')
@section('title')  کامنت ها   @endsection

@section('content')
    @component('panel.components.breadcrumb')
        @slot('title')  کامنت ها  @endslot
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
                                <th>متن</th>
                                <th> کاربر </th>
                                <th> برای؟ </th>
                                <th> وضعیت تایید </th>
                                <th> تاریخ ایجاد </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $comment->body }}</td>
                                <td>{{ $comment->user->name ?? '-' }}</td>
                                <td>{{ $comment->commentable->name ?? '-' }}</td>
                                <td>
                                    <span id="comment-status-show-{{ $comment->id }}" class="badge
                                     {{ $comment->is_approved  == \App\Models\Comment::STATUS_NEW ? 'bg-warning' : '' }}
                                    {{ $comment->is_approved  == \App\Models\Comment::STATUS_APPROVED ? 'bg-success'  : '' }}
                                    {{ $comment->is_approved  == \App\Models\Comment::STATUS_NOT_APPROVED ? 'bg-danger'  : '' }}
                                        ">
                                        {{ $comment->is_approved  == \App\Models\Comment::STATUS_NEW ? 'جدید' : '' }}
                                        {{ $comment->is_approved  == \App\Models\Comment::STATUS_APPROVED ? 'تایید شده' : '' }}
                                        {{ $comment->is_approved  == \App\Models\Comment::STATUS_NOT_APPROVED ? 'تایید نشده'  : ''}}
                                    </span>
                                </td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="changeStatus(event , '{{ route('panel.comments.changeStatus' , $comment->id) }}' , '{{ $comment->id }}')">
                                        <i id="comment-status-i-{{ $comment->id }}" class="fas {{ $comment->is_approved ? 'fa-lock-open' : 'fa-lock' }}
                                            fa-15m {{ $comment->is_approved ? 'text-success' : 'text-danger' }}"></i></a>

                                    <a  class="btn btn-sm bg-transparent d-inline delete-confirm"
                                        onclick="deleteItem(event , '{{ route('panel.comments.destroy' , $comment->id) }}')"><i
                                            class="fas fa-trash fa-15m text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                             <span>   {!! $comments->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

@section('script')
    <script>
        function changeStatus(event , url , commentId) {
           if(confirm('آیا از تغییر وضعیت این کامنت اطمینان دارید ؟')){
               $.post(url , { _token : '{{ csrf_token() }}' })
                .done(function (response) {
                    if(response.data.is_approved == 1){
                        $('#comment-status-i-' + commentId ).addClass(['fa-lock-open' , 'text-success']).removeClass(['fa-lock' , 'text-danger'])
                        $('#comment-status-show-' + commentId ).addClass('bg-success').removeClass('bg-danger').removeClass('bg-warning')
                        $('#comment-status-show-' + commentId ).html('تایید شده')
                    }else{
                        $('#comment-status-i-' + commentId ).addClass(['fa-lock' , 'text-danger']).removeClass(['fa-lock-open' , 'text-success'])
                        $('#comment-status-show-' + commentId ).addClass('bg-danger').removeClass('bg-success').removeClass('bg-warning')
                        $('#comment-status-show-' + commentId ).html(' تایید نشده')
                    }
                   })

               .fail(function () {

               })

        }}
    </script>
@endsection
