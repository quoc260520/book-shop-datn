@extends('backend.dashboard')
@section('content-body')
    @include('backend.book.includes._list')
    <div class="modal fade" data-bs-backdrop="static"
        id="book-detail" tabindex="-1">
        @include('backend.book.includes._modal_detail')
    </div>
@endsection
