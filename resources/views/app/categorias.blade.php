@extends('layouts.app')

@section('content')
<!-- Section -->
<section>
    <div class="container-fluid categoria-scale" style="width: 100% ;">
        <div class="row">
            <div class="col p-3">
            <h5 class="text-center p-3 m-auto">Categorias</h5>
            @if (Auth::user()->tech OR Auth::user()->admin )
            <button class="btn btn-sm btn-outline-success border-0 float-end" data-bs-toggle="modal" data-bs-target="#new-categoria">Nova Categoria <i class="bi bi-plus"></i></button>
            @endif
        </div>
        </div>

        <div id="load-categoria" class="row justify-content-center p-3">
            @foreach ( $categorias as $key => $categoria )
            <div class="card bg-white shadow rounded-custom border-0 m-2" style="width: 18rem;">
                <div class="card-body">
                <h6 class="card-title text-muted float-start">{{ $categoria->descricao }}</h6>
                <button class=" btn btn-sm float-end" id="navbarDropdown{{ $categoria->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown{{ $categoria->id }}">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detalhe-categoria{{ $categoria->id }}">Detalhes <i class="bi bi-list-check float-end"></i></a></li>
                    @if (Auth::user()->tech OR Auth::user()->admin )
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_categoria{{ $categoria->id }}">Editar <i class="bi bi-pen float-end"></i></a></li>
                        @if (Auth::user()->admin )
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#excluir-categoria{{ $categoria->id }}">Excluir <i class="bi bi-x float-end"></i></a></li>
                        @endif
                    @endif
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        @if(Session::get('error'))
            <div class="col-6 m-auto alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <strong>{{ Session::get('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

</section>
{{-- <section id="load-section"> --}}
<section id="load-section">
@foreach ( $categorias as $key => $categoria )

<!-- Modal Detalhe Categoria -->
<div class="modal fade" id="detalhe-categoria{{ $categoria->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered div-scale">
        <div class="modal-content text-dark bg-transparent border-0">
            <div class="container-fluid bg-white shadow rounded-custom">
                <div class="modal-body p-1">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 p-3 m-auto">
                            <form class="row p-3 m-auto">
                                <div class=" col p-3 small mb-3">
                                    <h6 class="text-center">Informações Categoria: {{ $categoria->descricao }}</h6>
                                    <hr>
                                    <div class="row g-3 mt-2">
                                        <div class="col-12">
                                            <h6>Categoria: {{ $categoria->descricao }}</h6>
                                            <strong>Total de itens: </strong>
                                            <p>{{ count($categoria->produtos) }}</p>
                                            <strong>Data de criação: </strong>
                                            <p>{{ $categoria->created_at->translatedFormat('l, d \d\e F, Y') }} - Usuário: {{ $categoria->created_at_user_id }}</p>
                                            <strong>Data da ultima Atualização: </strong>
                                            <p>{{ $categoria->updated_at->translatedFormat('l, d \d\e F, Y') }} - Usuário: {{ $categoria->updated_at_user_id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm btn-outlinr-secondary border-0" data-bs-dismiss="modal">Sair <i class="bi bi-x"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar Categoria -->
@if (Auth::user()->tech OR Auth::user()->admin )
<div class="modal fade" id="update_categoria{{ $categoria->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered div-scale">
        <div class="modal-content bg-transparent border-0">
            <div class="container-fluid bg-white shadow rounded-custom">
                <div class="modal-body p-1 text-dark">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 p-3 m-auto">
                            <form id="form_update_categoria" class="row p-3 m-auto" action="{{ route('update_categoria', $categoria->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class=" col p-3 small mb-3">
                                    <h6 class="text-center">Edição Categoria</h6>
                                    <div class="row g-3 mt-2">
                                        <div class="col-12">
                                            <label class="form-label">Descrição</label>
                                            <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" value="{{ $categoria->descricao }}" name="descricao" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button id="button-edit-categoria" class="btn btn-sm" type="submit">Salvar <i class="bi bi-check2"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal excluir Categoria -->
@if (Auth::user()->admin )
<div class="modal fade" id="excluir-categoria{{ $categoria->id }}" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered div-scale">
        <div class="modal-content bg-transparent border-0">
            <div class="container-fluid bg-dark text-white shadow rounded-custom">
                <div class="modal-body p-1">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 p-3 m-auto">
                            <div class="row p-3 m-auto">
                                <div class=" col p-3 small mb-3">
                                    <h5 class="text-center">Atenção <i class="bi bi-exclamation-triangle"></i></h5>
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 text-center">
                                            <h6>Deseja realmente excluir essa Categoria?</h6>
                                            <h6>{{ $categoria->descricao }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button class="btn btn-sm text-white" id="delete_categoria"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete_categoria{{$categoria->id}}').submit();">Sim <i class="bi bi-check"></i>
                                        </button>
                                        <form id="delete_categoria{{$categoria->id}}" action="{{ route('delete_categoria', $categoria->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method("DELETE")
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endforeach
</section>

<section id="load_modal_form_new">
<!-- Modal Nova Categoria -->
@if (Auth::user()->tech OR Auth::user()->admin )
<div class="modal fade" id="new-categoria" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-hidden="flase">
    <div class="modal-dialog modal-dialog-centered div-scale">
        <div class="modal-content text-dark bg-transparent border-0">
            <div class="container-fluid bg-white shadow rounded-custom">
                <div class="modal-body p-3">
                    <h6 class="modal-title">Cadastro de Categoria</h6>
                    <div class="row p-1">
                        <form class="row g-3" id="new_categoria" action="{{ route('new_categoria') }}" method="post">
                            @csrf
                            <div class="col-12 col-sm-12 p-3 m-auto">
                                <div class="col">
                                    <label class="form-label">Nova Categoria</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="text" oninput="handleInput(event)" data-name="form-new-categoria" class="form-control form-control-sm rounded-pill" name="descricao" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col">
                                <div class="col float-end">
                                    <button type="button" id="" class="btn btn-sm m-1" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                    <button class="btn btn-sm m-1" id="button-new-categoria" type="submit">Salvar <i class="bi bi-check2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</section>

@endsection
