@extends('backend.dashboard')
@section('content-body')
    @yield('list-voucher')
    @yield('create-voucher')
    @yield('update-voucher')
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush