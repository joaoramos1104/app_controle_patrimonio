@extends('layouts.app')

@section('content')
<section id="load-section">
    <div class="container-fluid p-3 div-scale">
        <div class="row p-2 small">
            <div class="card border-0">
                <div class="card-header text-center border-0 bg-transparent">
                    <h5>Detalhes da Empresa</h5>
                </div>
                @if(Session::get('error'))
                <div class="col-6 m-auto alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <strong>{{ Session::get('error') }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 m-auto">
                            <div class="row g-2 p-3">
                                <div class="col-3 m-auto">
                                    <a href="#"><img src="@if(isset($empresa->url_logo )){{ env('APP_URL') }}/storage/{{ $empresa->url_logo }} @else {{ '/assets/img/logo/logo_empresa.png' }} @endif" class="logo_empresa" alt="logo"></a>
                                </div>
                                <div class="col-9">
                                    <h5><strong>NOME / RAZÃO SOCIAL: </strong>{{ $empresa->razao_social }}</h5>
                                    <h6><strong>FANTASIA: </strong>{{ $empresa->fantasia }}</h6>
                                    <h6><strong>CPF/CNPJ: </strong>{{ $empresa->cnpj }}</h6>
                                </div>
                            </div>
                            <div class="row g-2 mt-1">
                                <div class="col-md-4 col-sm-12">
                                    <h6>Itens ativos:</h6>
                                    <h6 class=" text-success">{{ $ativo }}</h6>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <h6>Itens inativos:</h6>
                                    <h6 class=" text-danger">{{ $inativo }}</h6>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <a href="{{ route('itens_empresa', $empresa->id)  }}" type="button" class="btn btn-outline-success border-0 shadow">Listar itens <i class="bi bi-list-check"></i></a>
                                </div>
                                <hr>
                            </div>
                            <div class="row g-2 mt-1">
                                <div class="col-md-6 col-sm-12">
                                    <h6>Data de Criação:</h6>
                                    <i class=" text-success">{{ $empresa->created_at->translatedFormat('l, d \d\e F, Y') }}</i>
                                    <p class=" text-success">Usuário: {{ $created_user->name }}</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <h6>Data da ultima Atualização:</h6>
                                    <i class=" text-success">{{ $empresa->updated_at->translatedFormat('l, d \d\e F, Y') }}</i>
                                    <p class=" text-success">Usuário: {{ $updated_user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="row g-2 mt-2">
                                <h6>Endereço:</h6>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label">CEP</label>
                                    <p class="item">{{ $empresa->endereco[0]->cep }}</p>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <label class="form-label">Rua</label>
                                    <p class="item">{{ $empresa->endereco[0]->logradouro }}</p>
                                </div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col-md-2 col-sm-12">
                                    <label class="form-label">Número</label>
                                    <p class="item">{{ $empresa->endereco[0]->numero }}</p>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label class="form-label">Complemeto</label>
                                    <p class="item">{{ $empresa->endereco[0]->complemento }}</p>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label class="form-label">Bairro</label>
                                    <p class="item">{{ $empresa->endereco[0]->bairro }}</p>
                                </div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col-md-8 col-sm-12">
                                    <label class="form-label">Cidade</label>
                                    <p class="item">{{ $empresa->endereco[0]->cidade }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label">UF</label>
                                    <p class="item">{{ $empresa->endereco[0]->uf }}</p>
                                </div>
                                <hr>
                            </div>
                            <div class="row g-2 mb-2">
                                <h6>Contato:</h6>
                                <div class="col-12">
                                    <label class="form-label">E-mail</label>
                                    <p class="item">{{ $empresa->contato[0]->email }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label">Telefone 1</label>
                                    <p class="item">{{ $empresa->contato[0]->telefone1 }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label">Telefone 2</label>
                                    <p class="item">{{ $empresa->contato[0]->telefone2 }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label">Telefone 3</label>
                                    <p class="item">{{ $empresa->contato[0]->telefone3 }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="float-start">
                                <a href="{{ route('empresas') }}" class="btn"><i class="bi bi-arrow-left"></i> Voltar</a>
                            </div>
                            <div class="col float-end">
                                @if (Auth::user()->tech OR Auth::user()->admin )
                                    @if (Auth::user()->admin )
                                    <button type="button" class="btn btn-sm btn-danger m-1" data-bs-toggle="modal" data-bs-target="#excluir-empresa{{ $empresa->id }}">Excluir <i class="bi bi-x"></i></button>
                                    @endif
                                <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editar-empresa{{ $empresa->id }}">Editar <i class="bi bi-pen"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Modal excluir empresa-->
@if (Auth::user()->admin )
<div class="modal fade" id="excluir-empresa{{ $empresa->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered div-scale">
        <div class="modal-content bg-transparent border-0">
            <div class="container-fluid bg-dark text-white shadow rounded-custom">
                <div class="modal-body p-1">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 p-3 m-auto">
                            <div class="row p-3 small m-auto">
                                <div class=" col p-3 small mb-3">
                                    <h5 class="text-center">Atenção <i class="bi bi-exclamation-triangle"></i></h5>
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 text-center">
                                            <h6>Tem certeza que deseja excluir a Empresa / Cliente abaixo?</h6>
                                            <p>ID:{{ $empresa->id }} - {{ $empresa->razao_social }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button class="btn btn-sm text-white" type="submit" id="button-delete_empresa"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete_empresa{{$empresa->id}}').submit();">Sim <i class="bi bi-check"></i>
                                        </button>
                                        <form id="delete_empresa{{$empresa->id}}" action="{{ route('delete_empresa', $empresa->id) }}" method="POST" class="d-none">
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


<!-- Modal editar empresa -->
@if (Auth::user()->tech OR Auth::user()->admin )
<div class="modal fade" id="editar-empresa{{ $empresa->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content text-dark bg-transparent border-0 div-scale">
                <div class="container-fluid bg-white shadow rounded-custom small">
                    <div class="modal-body p-1">
                        <div class="row p-1">
                            <div class="col-12 col-sm-12 p-3 m-auto">
                                <form id="form_edit_empresa" class="row m-auto small" action="{{ route('update_empresa', $empresa->id ) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="text-center p-2">Editar Empresa</h6>
                                    <div class="p-2">
                                        <div class="row p-3">
                                            <div class="col-2 m-auto">
                                                <a href="#"><img src="@if(isset($empresa->url_logo )){{ env('APP_URL') }}/storage/{{ $empresa->url_logo }}@else {{ '/assets/img/logo/logo_empresa.png' }} @endif" class="logo_empresa" alt="logo"></a>
                                            </div>
                                            <div class="col-8">
                                                <label class="form-label">Carregar novo Logo</label>
                                                <input class="form-control form-control-sm rounded-pill" type="file" name="logo">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                                                <label class="form-label">Nome / Razão Social</label>
                                                <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="razao_social" value="{{ $empresa->razao_social }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label">Nome Fantasia</label>
                                                <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="fantasia" value="{{ $empresa->fantasia }}" required>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label">CPF/CNPJ</label>
                                                <input type="text"  id="cpfCnpj" maxlength="18" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="cnpj" value="{{ $empresa->cnpj }}" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-2">
                                            <h6>Endereço:</h6>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label">CEP *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="cep"value="{{ $empresa->endereco[0]->cep }}" required>
                                            </div>
                                            <div class="col-md-8 col-sm-12">
                                                <label class="form-label">Rua *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="rua" value="{{ $empresa->endereco[0]->logradouro }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-2 col-sm-12">
                                                <label class="form-label">Número *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="numero" value="{{ $empresa->endereco[0]->numero }}" required>
                                            </div>
                                            <div class="col-md-5 col-sm-12">
                                                <label class="form-label">Complemeto</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="complemento" value="{{ $empresa->endereco[0]->complemento }}">
                                            </div>
                                            <div class="col-md-5 col-sm-12">
                                                <label class="form-label">Bairro *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="bairro" value="{{ $empresa->endereco[0]->bairro }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-8 col-sm-12">
                                                <label class="form-label">Cidade *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="cidade" value="{{ $empresa->endereco[0]->cidade }}" required>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label">UF *</label>
                                                <input type="text" class="form-control form-control-sm rounded-pill" name="uf" value="{{ $empresa->endereco[0]->uf }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-2">
                                        <h6>Contato:</h6>
                                        <div class="col-md-8 col-sm-12">
                                            <label class="form-label">E-mail *</label>
                                            <input type="email" class="form-control form-control-sm rounded-pill" name="email" value="{{ $empresa->contato[0]->email }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Telefone 1 *</label>
                                            <input type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" name="telefone1" value="{{ $empresa->contato[0]->telefone1 }}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"; required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Telefone 2</label>
                                            <input type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" name="telefone2" value="{{ $empresa->contato[0]->telefone2 }}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Telefone 3</label>
                                            <input type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" name="telefone3" value="{{ $empresa->contato[0]->telefone3 }}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col">
                                        <div class="col float-end">
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                            <button id="button-edit-empresa" type="submit" class="btn btn-sm btn-success">Salvar <i class="bi bi-check2"></i></button>
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

</section>
@endsection
