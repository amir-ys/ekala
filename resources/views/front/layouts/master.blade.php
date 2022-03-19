
<!DOCTYPE html>
<html class="no-js" lang="zxx">
@include('front.layouts.head')
<body>
<div class="wrapper">

    @include('front.layouts.header')
    @include('front.layouts.offcanvas-mobile')

   @yield('content')

@include('front.layouts.footer')

<!-- Modal -->
@include('front.layouts.quick-view-modal')
<!-- Modal end -->
</div>

<!-- All JS is here
============================================ -->
@include('front.layouts.scripts')
</body>
</html>
