@extends('layouts.app')
@section('content')
<section>
    <div class="container p-3 div-scale">
        <div class="row p-2 small bg-white rounded-custom">
            <div class="card border-0">
                <div class="card-header text-center border-0 bg-transparent">
                    <h4>Perfil do Usuário</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 texte-center">
                            <div class="row g-2 p-3">
                                <div class="col-3">
                                    <a href="#"><img src="@if(isset($user->photo_perfil )){{ env('APP_URL') }}/storage/{{ $user->photo_perfil }} @else {{ '/assets/img/profile/profile.png' }} @endif" class="img-profile rounded-custom" alt="img-profile"></a>
                                </div>
                                <div class="col-9">
                                    <h5>Nome: {{ $user->name }}</h5>
                                    <h6><strong>E-mail: </strong>{{ $user->email }}</h6>
                                    <h6><strong>Telefone: </strong> {{ $user->phone }}</h6>
                                    <p class="card-text"><small class="text-muted"><strong>Status: </strong> @if($user->active == 1) <i class="text-success">Ativo</i> @else <i class="text-danger">Inativo</i>@endif</small></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if($user->user == 1) checked @endif disabled>
                                        <label class="form-check-label">
                                            Usuário Padrão
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if($user->tech == 1) checked @else @endif disabled>
                                        <label class="form-check-label">
                                            Técnico
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if($user->admin == 1) checked @else @endif disabled>
                                        <label class="form-check-label">
                                            Adminstrador
                                        </label>
                                    </div>
                                    @if (Auth::user()->id == $user->id )
                                    <div class="mt-3">
                                        <a class="btn btn-outline-success border-0" data-bs-toggle="collapse" href="#alterarSenha" role="button" aria-expanded="false" aria-controls="alterarSenha">
                                            Alterar Senha <i class="bi bi-pen"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row g-2 mt-1">
                                <div class="col-12">
                                    <h6>Data de inclusão:</h6>
                                    <i class=" text-success">@if(isset($user->created_at)){{ $user->created_at->translatedFormat('l, d/ m/ Y') }}@endif</i>
                                </div>
                                <div class="col-12">
                                    <h6>Data da ultima Atualização:</h6>
                                    <i class=" text-success">@if(isset($user->updated_at)){{ $user->updated_at->translatedFormat('l, d/ m/ Y') }}@endif</i>
                                </div>
                            </div>
                        </div>
                        @if(Session::get('error'))
                        <div class="col-6 m-auto alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <strong>{{ Session::get('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (Auth::user()->id == $user->id )
                        <div class="collapse" id="alterarSenha">
                            <div  id="formNewPassword" class="col-12 float-end">
                                <h6>Alterar Senha</h6>
                                <div class="row g-2 mt-1">
                                    <form id="form_new_password" method="post" action="{{ route('alter_password',$user->id ) }}">
                                        <div id="password" class="col-md-6 col-sm-12">
                                            <label class="form-label">Nova Senha *</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input type="password" class="form-control form-control-sm" data-name="new-password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Confirmar Nova Senha *</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input type="password" class="form-control form-control-sm" data-name="new-password" name="password_confirmation" required>
                                            </div>
                                            <div class="col float-end">
                                                <button type="button" id="cancel_alter_password" class="btn btn-sm btn-warning m-1">Cancelar <i class="bi bi-x"></i></button>
                                                <button type="submit" id="button-new-password" class="btn btn-sm btn-success">Salvar <i class="bi bi-check"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <div class="col">
                            <div class="float-start">
                                @if (Auth::user()->tech OR Auth::user()->admin )
                                <a href="{{ route('users') }}" class="btn"><i class="bi bi-arrow-left"></i> Voltar</a>
                                @else
                                <a href="{{ route('home') }}" class="btn"><i class="bi bi-arrow-left"></i> Voltar</a>
                                @endif
                            </div>
                            @if (Auth::user()->admin )
                            <div class="col float-end">
                                <button type="button" class="btn btn-sm btn-danger m-1" data-bs-toggle="modal" data-bs-target="#excluir-user{{ $user->id }}">Excluir <i class="bi bi-x"></i></button>
                                <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editar-user{{ $user->id }}">Editar <i class="bi bi-pen"></i></button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Edit User -->
@if (Auth::user()->admin )
<div class="modal fade" id="editar-user{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark bg-transparent border-0 edit-user-scale">
            <div class="container-fluid bg-white shadow rounded-custom">
                <div class="modal-header bg-white border-0">
                    <h5 class="modal-title">{{ 'Editar Usuário ' }}</h5>
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="modal-body p-3">
                    <div class="row p-3">
                        <div class="col-12 col-sm-12 p-3 m-auto">
                            <form class="row g-3" method="POST" action="{{ route('update_user', $user->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Nome</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-bounding-box"></i></span>
                                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label  class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" maxlength="15" class="form-control form-control-sm" name="phone" value="{{ $user->phone }}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Photo Perfil</label>
                                    <input class="form-control form-control-sm rounded-pill" type="file" name="photo_perfil" multiple>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text">@</span>
                                        <input type="email" class="form-control form-control-sm" aria-describedby="inputGroupPrepend" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Nova Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control form-control-sm" name="password">
                                        <span>A senha deve conter no mínimo 8 digitos! *</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Confirmar Nova Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control form-control-sm" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"><strong>Status</strong></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="status_user" type="checkbox" id="active" @if($user->active === 1) checked @else  @endif>
                                        <label class="form-check-label activelabel"><strong class="strong-active">@if($user->active === 1)  Ativo @else Inativo @endif</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"><strong>Usuário Padrão</strong></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="padrao_user" type="checkbox" id="user" @if($user->user === 1) checked @else  @endif>
                                        <label class="form-check-label userlabel"><strong class="strong-user">@if($user->user === 1) Sim @else Não @endif</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"><strong>Técnico</strong></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="tech_user" type="checkbox" id="tech" @if($user->tech === 1) checked @else  @endif>
                                        <label class="form-check-label techlabel"><strong class="strong-tech">@if($user->tech === 1) Sim @else Não @endif</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"><strong>Administrador</strong></label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="admin_user" type="checkbox" id="admin" @if($user->admin === 1) checked @else @endif>
                                        <label class="form-check-label adminlabel"><strong class="strong-admin">@if($user->admin === 1) Sim @else Não @endif</strong></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm btn-warning m-1 shadow" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button class="btn btn-sm btn-success m-1 shadow" type="submit">Salvar <i class="bi bi-check2"></i></button>
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

<!-- Modal excluir User -->
@if (Auth::user()->admin )
<div class="modal fade" id="excluir-user{{ $user->id }}" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                            <h6>Deseja realmente excluir essa Usuário?</h6>
                                            <h6>{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button class="btn btn-sm text-white" id="delete_user"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete_user{{$user->id}}').submit();">Sim <i class="bi bi-check"></i>
                                        </button>
                                        <form id="delete_user{{$user->id}}" action="{{ route('delete_user', $user->id) }}" method="POST" class="d-none">
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
@endsection
