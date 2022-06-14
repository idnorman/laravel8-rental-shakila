@extends('panel.layouts.skeleton')

	@section('title')
		@yield('title', 'Rental Shakira')
	@endsection
	@section('custom-import-css')
		@yield('custom-import-css')
	@endsection
	@section('app')
	<body class="hold-transition sidebar-mini accent-teal">
  		<div class="wrapper">


		@include('panel.partials.sidebar')
		@include('panel.partials.topbar')

		@yield('content')
		<!-- Main Footer -->
		<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
		@section('custom-import-js')
			@yield('custom-import-js')
		@endsection
		@section('custom-js')
			@yield('custom-js')
		@endsection
	@endsection
		
	<!-- ./wrapper -->