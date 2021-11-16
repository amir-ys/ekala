
<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.rtl.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/jquery.toast.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/app.rtl.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/custom.css?v=' . uniqid()) }}" id="app-style" rel="stylesheet" type="text/css" />

@yield('css')
