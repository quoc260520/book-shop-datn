@extends('backend.dashboard')
@section('content-body')
    @include('backend.order.includes._list')
    <div class="modal fade" data-bs-backdrop="static"
        id="order-detail" tabindex="-1">
        @include('backend.order.includes._modal_detail')
    </div>
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush