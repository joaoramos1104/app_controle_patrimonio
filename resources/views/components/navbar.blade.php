<!-- Navbar menu -->
<nav class="navbar fixed-top navbar-expand-md navbar-light bg-white small">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo/logo2.png') }}" alt="" class="nav-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownItem" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Itens
                </a>
            <ul class="dropdown-menu  dropdown-menu-dark shadow border-0 rounded-custom" aria-labelledby="navbarDropdownItem">
                <li class="small"><a class="dropdown-item" href="{{ route('itens') }}">Itens</a></li>
                <li class="small"><a class="dropdown-item" href="{{ route('itens_inativos') }}">Itens Inativos</a></li>
                @if (Auth::user()->tech OR Auth::user()->admin )
                <li class="small"><a class="dropdown-item" href="{{ route('cadastro_itens') }}">Novo Item</a></li>
                @endif
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('categorias') }}">Categorias</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('empresas') }}">Empresas</a></li>
        </ul>
        <ul class="navbar-nav dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="@if(isset(Auth::user()->photo_perfil )){{ env('APP_URL') }}/storage/{{ Auth::user()->photo_perfil }} @else {{ '/assets/img/profile/profile.png' }} @endif" alt="" width="32" height="32" class="rounded-circle me-2">
                <i>{{ Auth::user()->name }}</i>
            </a>
                <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownUser">
                    <li class="small"><a class="dropdown-item" href="{{ route('show_perfil_user', Auth::user()->id) }}">Ver Perfil</a></li>
                    @if (Auth::user()->tech OR Auth::user()->admin )
                    <li class="small"><a class="dropdown-item" href="{{ route('users') }}">Lista de Usuários</a></li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li class="small">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Sair') }}
                        <i class="bi bi-box-arrow-right float-end"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </ul>
            </ul>
        </div>
    </div>
</nav>
