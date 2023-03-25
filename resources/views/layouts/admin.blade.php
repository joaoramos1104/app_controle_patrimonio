<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="assets/img/logo/logo2.png">
        <title>Login - Controle de bens Patrimonial</title>

        {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

        <!-- Bootstrap css-->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap-icons-1.9.1/bootstrap-icons.css') }}">

        {{-- <!-- Data Tables css -->
        <link rel="stylesheet" href="{{ asset('assets//css/data-tables/data-tables.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/data-tables/tables.css') }}"> --}}

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />

        <script crossorigin="anonymous" src="https://unpkg.com/typeit@8.7.0/dist/index.umd.js" defer></script>

    </head>
<body>

            @yield('content')

    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery/jquery-3.6.3.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>

    {{-- <!-- Data Tables js -->
    <script src="{{ asset('assets/js/data-tables/jquery-data-tables.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-tables/data-tables-act.js') }}"></script>
    <script src="{{ asset('assets/js/data-tables/datatable.js') }}"></script> --}}

        <!-- app.js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
