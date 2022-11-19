@extends('backend.dashboard')
@section('content-body')
    @include('backend.slider.includes._list')
    <div class="modal fade" data-bs-backdrop="static"
        id="slider-detail" tabindex="-1">
        @include('backend.slider.includes._modal_detail')
    </div>
@endsection
@push('after-scripts')
    <script src={{ asset('./js/slider.js') }}> </script>
@endpush