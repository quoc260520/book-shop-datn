@extends('backend.dashboard')
@section('content-body')
    @yield('list-author')
    @yield('create-author')
    @yield('update-author')
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush