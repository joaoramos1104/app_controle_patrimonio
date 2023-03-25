<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="assets/img/logo/logo2.png">
        <title>Controle de bens Patrimonial</title>
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

        <!-- Normalize -->
        <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!-- Bootstrap css-->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap-icons-1.9.1/bootstrap-icons.css') }}">

        <!-- Data Tables css -->
        <link rel="stylesheet" href="{{ asset('assets//css/data-tables/data-tables.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/data-tables/tables.css') }}">

        <!-- animate CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

        <!-- notification CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/notification/notification.css') }}">

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />

        <!-- Chat JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    </head>
<body>

    <main class="py-1">
        <x-navbar />
            @yield('content')
        {{-- <x-footer /> --}}
        <!-- Modal loading -->
        <div class="modal fade" id="loading" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark shadow-lg">

                    <div class="modal-body">
                        <div class="d-flex justify-content-center text-success">
                            <div class="spinner-border" role="status"> </div>
                            <strong> Aguarde...</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery/jquery-3.6.3.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>

    <!-- Data Tables js -->
    <script src="{{ asset('assets/js/data-tables/jquery-data-tables.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-tables/datatable.js') }}"></script>

    <!--  notification JS -->
    <script src="{{ asset('assets/js/notification/bootstrap-growl.min.js') }}"></script>

    <!-- app.js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- mask.js -->
    <script src="{{ asset('assets/js/mask.js') }}"></script>

    <!-- user.js -->
    <script src="{{ asset('assets/js/user.js') }}"></script>
</body>
</html>
