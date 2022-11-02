<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/logo/icon.svg') }}"/>
    @stack('before-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">

    @stack('after-styles')
    
</head>
<body>
    <div class="container-fluid">
        @include('partials.message')
        @yield('content')
    </div>

    @stack('before-scripts')
        <script src="{{ asset(mix('js/app.js'))}}"></script>
        <script src="js/adminlte.js"></script>

    @stack('after-scripts')
    @yield('script')

    
</body>

</html>
