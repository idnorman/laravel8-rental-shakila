@extends('main.layouts.skeleton')
@section('title')
  @yield('title', 'Rental Shakira')
@endsection
@section('custom-import-css')
	@yield('custom-import-css')
@endsection
@section('custom-css')
	@yield('custom-css')
@endsection
@section('app')
	@include('main.partials.header')
	@include('main.partials.rentalBar')

	@yield('content')

	@include('main.partials.footer')
	@section('custom-import-js')
		@yield('custom-import-js')
	@endsection
	@section('custom-js')
		@yield('custom-js')
		
	@endsection
@endsection