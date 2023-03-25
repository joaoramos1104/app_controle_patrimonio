@extends('layouts.app')
@section('content')
<section id="load-section">
<div class="container-fluid scale-user" style="width: 100% ;">
    <div class="row">
        <div class="col p-1">
            <h5 class="text-center">Usuários</h5>
            <hr>
            @if (Auth::user()->admin )
            <button class="btn btn-sm btn-outline-success border-0 shadow float-end" data-bs-toggle="modal" data-bs-target="#new-user">Novo Usuário <i class="bi bi-person-fill"></i></i></button>
            @endif
        </div>
    </div>
    <div class="row justify-content-center scroll_user">
        @foreach ($users as $user )
            <div class="card m-auto g-2 p-1 border-0 bg-transparent" style="width: 25rem;">
                <div class="row bg-white p-1 shadow rounded-custom">
                    <div class="col-md-3">
                        <img src="@if(isset($user->photo_perfil )){{ env('APP_URL') }}/storage/{{ $user->photo_perfil }} @else {{ '/assets/img/profile/profile.png' }} @endif" class="img-fluid rounded-custom" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <span>E-mail:</span>
                            <p class="card-text">{{ $user->email }}</p>
                            <p class="card-text">Telefone: {{ $user->phone }}</p>
                            <p class="card-text"><small class="text-muted">Status: @if($user->active == 1) <i class="text-success">Ativo</i> @else <i class="text-danger">Inativo</i>@endif</small></p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('perfil_user',$user->id) }}" class="btn btn-sm btn-outline-success border-0 shadow float-end">Ver perfil <i class="bi bi-person-lines-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <!-- Modal Novo User -->
    <div class="modal fade" id="new-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelNewUser" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-dark bg-transparent border-0 div-scale">
                <div class="container-fluid bg-white shadow rounded-custom">
                    <div class="modal-header bg-white border-0">
                        <h5 class="modal-title" id="staticBackdropLabelNewUser">{{ 'Novo Usuário ' }}</h5>
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                            <div class="col-12 col-sm-12 p-3 m-auto">
                                <form class="row g-2" id="form_new_user" method="POST" action="{{ route('new_user') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div id="name" class="col-12">
                                        <label class="form-label">Nome *</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-bounding-box"></i></span>
                                            <input type="text" class="form-control form-control-sm" data-name="new-user" name="name" value="" required>
                                        </div>
                                    </div>
                                    <div id="phone" class="col-md-6 col-sm-12">
                                        <label  class="form-label">Telefone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                            <input type="tel" maxlength="15" class="form-control form-control-sm" data-name="new-user" name="phone" value=""  onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" required>
                                        </div>
                                    </div>
                                    <div id="photo" class="col-md-6 col-sm-12">
                                        <label class="form-label">Photo Perfil</label>
                                        <input class="form-control form-control-sm rounded-pill" data-name="new-user" type="file" name="photo_perfil" multiple>
                                    </div>
                                    <div id="email" class="col-12">
                                        <label class="form-label">E-mail *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">@</span>
                                            <input type="email" class="form-control form-control-sm" aria-describedby="inputGroupPrepend" data-name="new-user" name="email" value="" required>
                                        </div>
                                    </div>
                                    <div id="password" class="col-md-6 col-sm-12">
                                        <label class="form-label">Senha *</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input type="password" class="form-control form-control-sm" data-name="new-user" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Confirmar Senha *</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input type="password" class="form-control form-control-sm" data-name="new-user" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="padrao_user" type="checkbox">
                                            <label class="form-check-label">Usuário Padrão</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="tech_user" type="checkbox">
                                            <label class="form-check-label">Técnico</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="admin_user" type="checkbox">
                                            <label class="form-check-label">Administrador</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Status</label>
                                        <select class="form-select form-select-sm" name="status_user" required>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col">
                                        <div class="col float-end">
                                            <button id="clean-form-new-user" type="button" class="btn btn-sm btn-warning m-1 shadow" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                            <button id="button-new-user" class="btn btn-sm btn-success m-1 shadow" type="submit">Salvar <i class="bi bi-check2"></i></button>
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
</section>
@endsection

