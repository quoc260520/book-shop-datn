@extends('backend.dashboard')
@section('content-body')
    @yield('list-publisher')
    @yield('create-publisher')
    @yield('update-publisher')
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush