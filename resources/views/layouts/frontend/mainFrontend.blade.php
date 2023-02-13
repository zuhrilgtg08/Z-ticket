<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Z-ᖷricket</title>

    <!-- link main -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="{{ asset('niceAdmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <!-- icon -->
	<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- css main -->
    @yield('style')
</head>
<body>
    @include('layouts.frontend.componentsFrontend.navbar')
        <div class="content">
            @yield('content')
        </div>
    @include('layouts.frontend.componentsFrontend.footer')
    
    <!-- script main -->
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('script')
</body>
</html>