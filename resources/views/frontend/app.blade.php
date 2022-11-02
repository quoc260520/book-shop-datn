<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <link href="{{ asset('images/logo/icon.svg') }}" rel="shortcut icon" type="image/jpg" />
    @stack('before-styles')
    {{-- Slick js --}}
    <link href="slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="slick/slick-theme.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css">


    @stack('after-styles')

</head>

<body>
    <div class="">
        @include('partials.message')
        @yield('content')
    </div>
    @stack('before-scripts')
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    @stack('after-scripts')
    @yield('script')


</body>
</html>
