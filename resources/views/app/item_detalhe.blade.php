@extends('layouts.app')

@section('content')
<!-- Section -->
<section id="load-section">
    <div class="container-fluid p-1">
        <div class="row p-3 detalhe-item-scale">
            <h5 class="text-center">Informações do Item</h5>
            <div class=" col-md-7 col-sm-12 p-2 mb-3">
                <div class="row">
                    <div class="col-3 m-auto">
                        <a href="#"><img src="@if(isset($show_item->empresa->url_logo )){{ env('APP_URL') }}/storage/{{ $show_item->empresa->url_logo }} @else {{ '/assets/img/logo/logo_empresa.png' }} @endif" class="logo_empresa" alt="logo"></a>
                    </div>
                    <div class="col-7">
                        <h5>{{ $show_item->empresa->razao_social }}</h5>
                        <h6><strong>CPF/CNPJ: </strong>{{ $show_item->empresa->cnpj }}</h6>
                    </div>
                    <div class="col-2 text-center">
                        <label class="form-label">Status</label>
                        <h6>
                        @if($show_item->status->descricao == "ATIVO")
                        <i class="text-success">{{ $show_item->status->descricao }}</i>
                        @else
                        <i class="text-danger">{{ $show_item->status->descricao }}</i>
                        @endif
                        </h6>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <p class="item">{{ $show_item->descricao }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Modelo</label>
                        <p class="item">{{ $show_item->modelo }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Categoria</label>
                        <p class="item">{{ $show_item->categoria->descricao }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Placa</label>
                        <p class="item">{{ $show_item->placa }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Chassis</label>
                        <p class="item">{{ $show_item->chassis }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Cor</label>
                        <p class="item">{{ $show_item->cor }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Tamanho</label>
                        <p class="item">{{ $show_item->tamanho }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Serial Number</label>
                        <p class="item">{{ $show_item->serial_number }}<p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Número do Ativo / Etiqueta</label>
                        <p class="item">{{ $show_item->num_ativo }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Quantidade</label>
                        <p class="item">{{ $show_item->qtd }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Condição</label>
                        <p class="item">{{ $show_item->condicao->descricao }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Valor</label>
                        <p class="item"><i>R$ </i>{{ number_format($show_item->valor, 2, ",", "."); }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Valor Depreciado</label>
                        <p class="item"><i>R$ </i>{{ number_format($show_item->valor_depr, 2, ",", "."); }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Taxa Depresiação Fiscal </label>
                        <p class="item">{{ number_format($show_item->tx_depreciacao, 2, ",", "."); }}<i>%</i></p>
                    </div>
                </div>
                {{-- <div class="row text-center">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Depreciação mensal Fiscal</label>
                        <p class="item"><i>R$ </i></p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Depr. Mensal Fiscal Acumulada</label>
                        <p class="item"><i>R$ </i></p>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Vida Útil</label>
                        <p type="text" class="item"></p>
                    </div>
                </div> --}}
                <div class="row text-center">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Bloco</label>
                        <p class="item">{{ $show_item->localizacaoProduto[0]->bloco }} </p>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Andar</label>
                        <p class="item">{{ $show_item->localizacaoProduto[0]->andar }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Localidade / Setor</label>
                        <p class="item">{{ $show_item->localizacaoProduto[0]->setor }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 p-3 m-auto bg-white">
                <div class="card m-auto border-0">
                    <div id="carouselInterval" class="carousel slide text-center" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ( $show_item->images as $key => $img )
                            <div class="carousel-item carousel-img  {{$key == 0 ? 'active' : '' }}" data-bs-interval="5000">
                                <img src=" @if(isset($img->phot_url )){{ env('APP_URL') }}/storage/{{ $img->phot_url }} @else {{ '/assets/img/item.png' }} @endif" class="card-img m-auto" alt="..." >
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @if(Session::get('success'))
                        <div class="col-6 m-auto alert alert-success alert-dismissible fade show m-3" role="alert">
                            <strong>{{ Session::get('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6>Observações:</h6>
                        <p class="card-text">{!! $show_item->observacao !!}</p>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h6>Data de Criação</h6>
                        <P class=" text-success">{{ $show_item->created_at->translatedFormat('l, d \d\e F, Y - H:m:s') }}</P>
                        <P class=" text-success">Usuário: {{ $created_user->name }}</P>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <h6>Data da ultima Atualização</h6>
                        <P class=" text-success">{{ $show_item->updated_at->translatedFormat('l, d \d\e F, Y - H:m:s') }}</P>
                        <P class=" text-success">Usuário: {{ $updated_user->name }}</P>
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
                    @if (Auth::user()->tech OR Auth::user()->admin )
                        @if (Auth::user()->admin )
                        <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#excluir-item{{ $show_item->id }}">Excluir Item <i class="bi bi-x"></i></button>
                        @endif
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#edit-item{{ $show_item->id }}">Editar item <i class="bi bi-pen"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- Modal excluir item-->
@if (Auth::user()->admin )
<div class="modal fade" id="excluir-item{{ $show_item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="excluir-item{{ $show_item->id }}Label" aria-hidden="true">
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
                                            <h6>Tem certeza que deseja excluir o item abaixo?</h6>
                                            <p>ID: {{ $show_item->id }} - {{ $show_item->descricao }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button class="btn btn-sm text-white" type="submit" id="button-delete_item{{ $show_item->id }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete_item{{$show_item->id}}').submit();">Sim <i class="bi bi-check"></i>
                                        </button>
                                        <form id="delete_item{{$show_item->id}}" action="{{ route('delete_item', $show_item->id) }}" method="POST" class="d-none">
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

<!-- Modal editar Item -->
@if (Auth::user()->tech OR Auth::user()->admin )
<div class="modal fade" id="edit-item{{ $show_item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEditItem{{ $show_item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered edit-item-scale">
        <div class="modal-content bg-transparent border-0">
            <div class="container-fluid bg-white text-dark shadow rounded-custom">
                <div class="modal-body p-1">
                    <div class="row p-1">
                        <div class="col-12 col-sm-12 m-auto">
                            <form id="form_edit_item" class="row m-auto" action="{{ route('update_item', $show_item->id ) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class=" col-md-7 col-sm-12 p-3 mb-3">
                                    <h6 class="text-center">Edição do Item</h6>
                                    <div class="row g-1 mt-2">
                                        <div class="col-12">
                                            <label class="form-label">Descrição</label>
                                            <input type="text" class="form-control" hidden value="{{ Auth::user()->id }}" name="user_id">
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_descricao" value="{{ $show_item->descricao }}" required>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Modelo</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_modelo" value="{{ $show_item->modelo }}" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Categoria</label>
                                            <select class="form-select form-select-sm rounded-pill" name="item_categoria" aria-label="Categoria">
                                                <option selected value="{{ $show_item->categoria->id }}">{{ $show_item->categoria->descricao  }}</option>
                                                @foreach ( $categorias as $categoria )
                                                <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Placa</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_placa" value="{{ $show_item->placa }}">
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label">Chassis</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_chassis" value="{{ $show_item->chassis }}">
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Cor</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_cor" value="{{ $show_item->cor }}">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Tamanho</label>
                                            <input type="text" oninput="handleInput(event)" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_tamanho" value="{{ $show_item->tamanho }}">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Serial Number</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_serial" value="{{ $show_item->serial_number }}">
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Número do Ativo / Etiqueta</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_etiqueta" value="{{ $show_item->num_ativo }}" required>
                                        </div>
                                        <div class="col-md-8 col-sm-12">
                                            <label class="form-label">Empresa</label>
                                            <select class="form-select form-select-sm rounded-pill" name="item_empresa" aria-label="Default select example">
                                                <option selected value="{{ $show_item->empresa->id }}">{{ $show_item->empresa->razao_social }}</option>
                                                @foreach ( $empresas as $empresa )
                                                <option value="{{ $empresa->id }}">{{ $empresa->razao_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Valor R$</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="valor" name="item_valor" value="{{ number_format($show_item->valor, 2, ",", "."); }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Valor Depreciado R$</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="item_valor_depr" name="item_valor_depr" value="{{ number_format($show_item->valor_depr, 2, ",", "."); }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Taxa Depresiação Fiscal %</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" id="tx_depreciacao" name="tx_depreciacao" value="{{ number_format($show_item->tx_depreciacao, 2, ",", "."); }}" required>
                                        </div>
                                    </div>
                                    {{-- <div class="row g-1 mt-1">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Depreciação mensal Fiscal</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" value="" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Depr. Mensal Fiscal Acumulada</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" value="" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label">Vida Útil</label>
                                            <input type="text" class="form-control form-control-sm rounded-pill" value="" disabled>
                                        </div>
                                    </div> --}}
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label">Bloco</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_bloco" value="{{ $show_item->localizacaoProduto[0]->bloco }}">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label">Andar</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_andar" value="{{ $show_item->localizacaoProduto[0]->andar }}">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label">Quantidade</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="qtd" value="{{ $show_item->qtd }}">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label">Condição</label>
                                            <select class="form-select form-select-sm rounded-pill" name="item_condicao" aria-label="Condição">
                                                <option selected value="{{ $show_item->condicao->id }}">{{ $show_item->condicao->descricao }}</option>
                                                @foreach ( $condicoes as $condicao )
                                                    <option value="{{ $condicao->id }}">{{ $condicao->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-1 mt-2">
                                        <div class="col-md-7 col-sm-12">
                                            <label class="form-label">Localidade / Setor</label>
                                            <input type="text" oninput="handleInput(event)" class="form-control form-control-sm rounded-pill" name="item_setor" value="{{ $show_item->localizacaoProduto[0]->setor }}" required>
                                        </div>
                                        <div class="col-md-5 col-sm-12">
                                            <label class="form-label">Status</label>
                                            <select class="form-select form-select-sm rounded-pill" name="item_status" aria-label="Status">
                                                <option selected value="{{ $show_item->status->id }}">{{ $show_item->status->descricao }}</option>
                                                @foreach ($status as $status_item )
                                                <option value="{{ $status_item->id }}">{{ $status_item->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 p-3 m-auto small">
                                    <div class="card m-auto border-0">
                                    <div class="row p-2 scroll">
                                        @foreach ($show_item->images as $image )
                                        <div class="col-md-6 col-sm-12">
                                            <img src="{{ env('APP_URL') }}/storage/{{ $image->phot_url }}" class="m-auto div-scale" alt="..." style="width: 90%; height: 70%;">
                                            <div class="col-6 p-1 m-auto">
                                            <button class="btn btn-sm btn-danger shadow"
                                                onclick="event.preventDefault();
                                                document.getElementById('delete_photo{{$image->id}}').submit();">Excluir <i class="bi bi-x"></i>
                                            </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 p-1">
                                        <div class="mb-1">
                                            <label class="form-label">Adicinar Photo <i class="bi bi-camera-fill"></i></label>
                                            <input class="form-control form-control-sm rounded-pill" name="phot_url[]" type="file" multiple>
                                        </div>
                                    </div>
                                    <div class="card-body border-0">
                                        <h6>Observações:</h6>
                                        <div class="mb-1">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="item_obs" rows="4">{{ $show_item->observacao }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="col">
                                    <div class="col float-end">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-dismiss="modal">Cancelar <i class="bi bi-x"></i></button>
                                        <button id="button-edit-item" type="submit" class="btn btn-sm btn-success">Salvar <i class="bi bi-check2"></i></button>
                                    </div>
                                </div>
                            </form>
                            @foreach ($show_item->images as $image )
                            <form id="delete_photo{{$image->id}}" action="{{ route('delete_photo', $image->id) }}" method="POST" class="d-none">
                                @csrf
                                @method("DELETE")
                            </form>
                            @endforeach
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
