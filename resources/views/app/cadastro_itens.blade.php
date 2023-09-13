@extends('layouts.app')

@section('content')
<!-- Section -->
<section>
    <div class="container-fluid div-scale" style="width: 100%;">
        <form class="row p-3 m-auto rounded small" id="form_new_item" action="new_item" method="post" enctype="multipart/form-data">
            @csrf
            <h5 class="text-center bg-success p-2 text-white rounded shadow">Cadastro de Itens de Patrimônio</h5>
            @error('item_qtd')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <div class="col-md-7 col-sm-12 mb-3 p-2">
                <div class="row g-2 mt-2">
                    <div class="col-12">
                        <label class="form-label">Descrição *</label>
                        <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_descricao" placeholder="Descrição" required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Modelo *</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_modelo" placeholder="Modelo" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Categoria *</label>
                        <button type="button" class="btn btn-sm btn-outline-ssuccess float-end" data-bs-toggle="modal" data-bs-target="#new-categoria">Nova Categoria <i class="bi bi-plus"></i></button>
                        <select id="select_categoria" class="form-select form-select-sm rounded-pill" name="item_categoria" aria-label="Categoria">
                            @foreach ($categorias as $categoria )
                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Placa</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_placa" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Chassis</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_chassis" placeholder="">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Cor</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_cor" placeholder="Cor" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Tamanho</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_tamanho" placeholder="1,60m x 1,00m">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Serial Number</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_serial" placeholder="*******">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Valor R$</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="valor" data-name="new-item" name="item_valor" placeholder="R$" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Valor Depreciado R$</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="item_valor_depr" data-name="new-item" name="item_valor_depr" placeholder="R$" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Taxa Depresiação Fiscal %</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="tx_depreciacao" name="tx_depreciacao" placeholder="%" required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Condição *</label>
                        <select class="form-select form-select-sm rounded-pill" name="item_condicao" aria-label="Condição">
                            @foreach ( $condicoes as $condicao )
                            <option value="{{ $condicao->id }}">{{ $condicao->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Número do Ativo / Etiqueta *</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_etiqueta" required>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <label class="form-label">Empresa *</label>
                        <button type="button" class="btn btn-sm btn-outline-ssuccess float-end" data-bs-toggle="modal" data-bs-target="#new-cliente">Nova Empresa/Cliente <i class="bi bi-plus"></i></button>
                        <select id="select_empresa" class="form-select form-select-sm rounded-pill" name="item_empresa">
                            @foreach ( $empresas as $empresa )
                            <option value="{{ $empresa->id }}">{{ $empresa->razao_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 mb-3 p-2">
                <div class="row g-2 mt-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Bloco</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_bloco" placeholder="02">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Andar</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_andar" placeholder="05">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Quantidade *</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" data-name="new-item" name="qtd" placeholder="01">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-8 col-sm-12">
                        <label class="form-label">Localidade *</label>
                        <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="new-item" name="item_setor" placeholder="Escritório" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Status</label>
                        <select class="form-select form-select-sm rounded-pill" name="item_status" aria-label="Status">
                            @foreach ( $status as $status_atual )
                            <option value="{{ $status_atual->id }}">{{ $status_atual->descricao  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Adicinar Photo <i class="bi bi-camera-fill"></i></label>
                            <input class="form-control form-control-sm rounded-pill" data-name="new-item" name="phot_url[]" type="file" multiple>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Observação</label>
                            <textarea class="form-control" data-name="new-item" name="item_obs" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col">
                <div class="float-start">
                    <a href="{{ route('itens') }}" class="btn"><i class="bi bi-arrow-left"></i> Voltar</a>
                </div>
                <div class="col float-end">
                    <button type="submit" class="btn btn-sm btn-success">Salvar <i class="bi bi-check2"></i></button>
                </div>
            </div>
        </form>
    </div>
</section>

<section id="load_form_modal">
<!-- Modal Nova Categoria -->
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


<!-- Modal Novo Empresa/Cliente -->
<div class="modal fade" id="new-cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelNewCliente" aria-hidden="true">
    <div class="modal-dialog modal-xl div-scale">
        <div class="modal-content text-dark bg-transparent border-0">
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
                                            <label class="form-label">Razão Social *</label>
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
                                            <label class="form-label">CNPJ *</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="cnpj" required>
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
                                        <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone1" placeholder="(21) 99999-8888">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label">Telefone 2</label>
                                        <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone2" placeholder="(21) 99999-8888">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label">Telefone 3</label>
                                        <input type="text" class="form-control form-control-sm rounded-pill" data-name="form-new-empresa" name="telefone3" placeholder="(21) 99999-8888">
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm btn-warning m-1" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
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
