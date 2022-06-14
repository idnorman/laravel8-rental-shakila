<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} &mdash; @yield('title', 'Rental Shakira')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('_panel/plugins/fontawesome-free/css/all.min.css') }}">
  @yield('custom-import-css')

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('_panel/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('_panel/dist/css/custom.css') }}">
</head>



    @yield('app')


  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('_panel/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('_panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('_panel/dist/js/adminlte.min.js') }}"></script>

  @yield('custom-import-js')
  <script>
  @yield('custom-js')
  </script>
</body>

</html>