@extends('backend.dashboard')
@section('content-body')
    @yield('list-account')
    @yield('create-account')
    @yield('update-account')
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush