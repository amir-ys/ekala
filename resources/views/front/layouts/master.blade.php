<!DOCTYPE html>
<html class="no-js" lang="zxx">
@include('front.layouts.head-css')
<body>
<div class="wrapper">
    @include('front.layouts.header')
        @yield('content')
    @include('front.layouts.footer')
    <!-- Modal -->
    @include('front.layouts.quick-view-modal')
    <!-- Modal end -->
</div>
<!-- All JS is here
============================================ -->
@include('front.layouts.foot')
</body>
</html>
