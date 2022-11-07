@extends('backend.app')
@section('content')

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
           <div class="col-sm-6">
           {!! Breadcrumbs::render() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="content-body">
        @include('partials.message')
        @yield('content-body')
      </div>

    </div>
  </div>
@endsection
@push('after-styles')
	 <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endpush
@push('after-scripts')
<script src="{{ asset('js/book.js') }}"></script>
@endpush
