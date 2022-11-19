@extends('backend.dashboard')
@section('content-body')
    @include('backend.category.includes._list')
    <div class="modal fade" data-bs-backdrop="static"
        id="category-detail">
        @include('backend.category.includes._modal_detail')
    </div>
@endsection
@push('after-scripts')
    <script src={{ asset('./js/category.js') }}> </script>
@endpush