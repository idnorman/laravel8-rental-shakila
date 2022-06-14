<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} &mdash; @yield('title', 'Rental Shakira')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('_main/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('_main/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('_main/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('_main/css/style.css') }}" rel="stylesheet">
    @yield('custom-import-css')

    @yield('custom-css')
</head>

<body>


@yield('app')
    <!-- JavaScript Libraries -->
    <script src="{{ asset('_main/js/jquery.min.js') }}"></script>
    <script src="{{ asset('_main/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('_main/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('_main/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('_main/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('_main/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('_main/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('_main/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    @yield('custom-import-js');

    <!-- Template Javascript -->
    <script src="{{ asset('_main/js/main.js') }}"></script>
    <script>
        @yield('custom-js')
    </script>
</body>

</html>