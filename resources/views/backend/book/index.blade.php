@extends('backend.dashboard')
@section('content-body')
    @include('backend.book.includes._list')
    @include('backend.book.includes._modal_create')
@endsection
@push('after-scripts')
<script src="{{ asset('js/book.js') }}"></script>
@endpush