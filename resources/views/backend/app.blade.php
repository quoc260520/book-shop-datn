<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <link href="{{ asset('images/logo/icon.svg') }}" rel="shortcut icon" type="image/jpg" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('before-styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    @stack('after-styles')

</head>

<body>
    <div class="wrapper">

        @include('backend.layout.navbar')

        @include('backend.layout.sidebar')

        <div class="container-fluid">
            @include('partials.message')
            @yield('content')
        </div>

        @include('backend.layout.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    @stack('before-scripts')
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('after-scripts')
    @yield('script')
</body>

</html>
