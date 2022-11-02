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
        @yield('content-body')
      </div>

    </div>
  </div>
@endsection
@push('after-styles')
	 <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endpush
