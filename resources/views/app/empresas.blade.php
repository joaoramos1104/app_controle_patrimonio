@extends('layouts.app')

@section('content')
    <!-- Section -->
    <section id="load-section">
        <div class="container-fluid" style="width: 90%;">
            <div id="load-empresas" class="row div-scale">
                <div class="p-3 m-auto bg-white rounded-custom">
                    <h5 class="text-center">Empresas / Clientes</h5>
                    @if (Auth::user()->tech OR Auth::user()->admin )
                    <button class="btn btn-sm btn-outline-success border-0 float-end mb-3" data-bs-toggle="modal" data-bs-target="#new-cliente">Nova Empresa <i class="bi bi-plus"></i></button>
                    @endif
                    <table id="empresas" class="table table-responsive-sm table-hover small" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome / Razão Social</th>
                                <th>Nome Fantasia</th>
                                <th>CPF/CNPJ</th>
                                <th>Endereço</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                            <tbody class="font-color-darkgrey">
                                @foreach ($empresas as $empresa )

                                <tr>
                                    <td>{{ $empresa->id }}</td>
                                    <td>{{ $empresa->razao_social }}</td>
                                    <td>{{ $empresa->fantasia }}</td>
                                    <td>{{ $empresa->cnpj }}</td>
                                    <td>{{ $empresa->endereco[0]->logradouro }}, {{ $empresa->endereco[0]->numero }}</td>
                                    <td>{{ $empresa->endereco[0]->bairro }}</td>
                                    <td>{{ $empresa->endereco[0]->cidade }}</td>
                                    <td>{{ $empresa->endereco[0]->uf }}</td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <button class="btn btn-outline-secondary border-0" type="button" id="dropdownMenuButton{{ $empresa->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton{{ $empresa->id }}">
                                                <li><a class="dropdown-item" href="{{ route('itens_empresa', $empresa->id) }}">Listar Itens <i class="bi bi-list float-end"></i></a></li>
                                                <li><a class="dropdown-item" href="{{ route('empresa_detalhe', $empresa->id) }}">Detalhes <i class="bi bi-view-list float-end"></i></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nome / Razão Social</th>
                                <th>Nome Fantasia</th>
                                <th>CPF/CNPJ</th>
                                <th>Endereço</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th>Ação</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



<!-- Modal Novo Empresa/Cliente -->
<div class="modal fade" id="new-cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelNewCliente" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-scale-empresa text-dark bg-transparent border-0">
            <div class="container-fluid">
                <div class="modal-body p-1">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 p-3 m-auto bg-white shadow rounded-custom">
                            <form class="row p-3 m-auto" id="form-new-empresa" action="{{ route('new_empresa') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h6 class="text-center p-2">Cadastro Empresa</h6>
                                <div class="p-2">
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-8 col-sm-12">
                                            <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                                            <label class="form-label">Nome / Razão Social *</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="razao_social" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Logo</label>
                                            <input class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" type="file" name="logo" multiple>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Nome Fantasia *</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="fantasia" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">CPF/CNPJ *</label>
                                            <input type="text" id="cpfCnpj" maxlength="18" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="cnpj" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-1 mt-2">
                                        <h6>Endereço:</h6>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">CEP *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="cep" placeholder="26000-000" onblur="getDadosEnderecoPorCEP(this.value)" required>
                                        </div>
                                        <div class="col-md-8 col-sm-12">
                                            <label class="form-label">Rua *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" id="logradouro" name="rua" required>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-2 col-sm-12">
                                            <label class="form-label">Número *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="numero" required>
                                        </div>
                                        <div class="col-md-5 col-sm-12">
                                            <label class="form-label">Complemeto</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" id="complemento" name="complemento">
                                        </div>
                                        <div class="col-md-5 col-sm-12">
                                            <label class="form-label">Bairro *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" id="bairro" name="bairro" required>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-8 col-sm-12">
                                            <label class="form-label">Cidade *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" id="cidade" name="cidade" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">UF *</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" id="uf" name="uf" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row g-1 mt-2">
                                    <h6>Contato:</h6>
                                    <div class="col-md-8 col-sm-12">
                                        <label class="form-label">E-mail *</label>
                                        <input type="email" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="email" placeholder="exemple@domain.com">
                                    </div>
                                </div>
                                <div class="row g-1 mb-2">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label">Telefone 1 *</label>
                                        <input type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone1" placeholder="(21) 99999-8888" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label">Telefone 2</label>
                                        <input  type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone2" placeholder="(21) 99999-8888" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label">Telefone 3</label>
                                        <input  type="tel" maxlength="15" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone3" placeholder="(21) 99999-8888" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button id="clean-form-new-empresa" type="button" class="btn btn-sm btn-warning m-1" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button type="submit" class="btn btn-sm btn-success">Salvar <i class="bi bi-check2"></i></button>
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
