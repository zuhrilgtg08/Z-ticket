<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="zuhril" content="">
        <title>Dashboard</title>

        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        
        <!-- Vendor CSS Files -->
        <link href="{{ asset('niceAdmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/boxicons/css/boxicons.min.css') }}/" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/quill/quill.bubble.css') }}/" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/remixicon/remixicon.css') }}/" rel="stylesheet">
        <link href="{{ asset('niceAdmin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
        
        <!-- Template Main CSS File -->
        <link href="{{ asset('niceAdmin/css/style.css') }}" rel="stylesheet">
        <!-- trix editor -->
        <link rel="stylesheet" href="{{ asset('assets/css/trix.css') }}">
    </head>

    <body>
        @include('layouts.dashboard.componentsDashboard.navbar')
        @include('layouts.dashboard.componentsDashboard.sidebar')

        <main id="main" class="main">
            @yield('breadcumb')
            <section class="section dashboard">
                <div class="row">
                    @yield('content-dashboard')
                </div>
            </section>
        </main>
        @include('layouts.dashboard.componentsDashboard.footer')

        <!-- Scroll to Top Button-->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('niceAdmin/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('niceAdmin/vendor/php-email-form/validate.js') }}"></script>
        
        <!-- Template Main JS File -->
        <script src="{{ asset('niceAdmin/js/main.js') }}"></script>
        <!-- bootstrap js bunndle -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- trix-editor -->
        <script src="{{ asset('assets/js/trix.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('sweetAlert/sweetalert2.all.min.js') }}"></script>
        @yield('script')
    </body>
</html>