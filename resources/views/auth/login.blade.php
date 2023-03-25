
@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-3 login-scale">
    <div class="row">
        <div class="col-md-4 col-sm-12 p-3 border-right">
            <h2 class="text-center text-white p-3">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control rounded-pill shadow @error('email') is-invalid @enderror" id="floatingInput" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                    <label for="floatingInput fs-5">E-mail</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control rounded-pill shadow @error('password') is-invalid @enderror" id="floatingPassword" name="password" required autocomplete="current-password" placeholder="password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-check mb-3 text-white">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembre-me</label>
                </div>
                <button type="submit" class="btn btn-success">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn fs-5 text-white" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif
                @if(Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <strong>{{ Session::get('error') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </form>
        </div>
        <div class="col-md-8 col-sm-12 text-center m-auto text-white">
            <div class="m-auto p-3 text-center d-none d-md-block d-lg-block d-xl-block">
                <img src="{{ asset('assets/img/svg/undraw_add_information_j2wg.svg') }}" alt="" style="width: 40%; ">
            </div>
            <h1 class="">
                <strong class="animated"></strong>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var description = 'Controle de Bens Patrimoniais'
                        new TypeIt(".animated", {
                            speed: 100,
                            loop: true,
                            delay: 500,
                        })
                            .type(description, {delay:600})
                            .delete(description.length)
                            .type(description, {delay:600})
                            .pause(1000)
                            .go();
                    });
                </script>
            </h1>
            <h4>Mantenha um controle dos bens patrimoniais de sua Empresa ou Clientes.</h4>
        </div>
    </div>
    <x-footer />
</div>
@endsection
