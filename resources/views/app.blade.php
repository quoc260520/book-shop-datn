<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
   
    {{-- {{ asset(mix('css/backend.css')) }} --}}

    @stack('after-styles')
    
</head>
<body>
    @yield('content')



    @stack('before-scripts')
        <script src="{{ asset(mix('js/app.js'))}}"></script>
    @stack('after-scripts')
    @yield('script')

    
</body>

</html>
