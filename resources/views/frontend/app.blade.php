<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <link href="{{ asset('images/logo/icon.svg') }}" rel="shortcut icon" type="image/jpg" />
    <link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link href="http://kenwheeler.github.io/slick/slick/slick-theme.css" rel="stylesheet" type="text/css" />
    @stack('before-styles')
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    @stack('after-styles')
</head>

<body>
    <div class="">
        <div class="overlay"></div>
        <div class="app app__container">
            @include('frontend.layout.topbar')
            @yield('content')
        </div>
    </div>
    @stack('before-scripts')
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/frontend.js') }}"></script>
    @stack('after-scripts')
    @yield('script')
</body>

</html>
