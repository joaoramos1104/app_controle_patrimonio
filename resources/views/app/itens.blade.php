@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="row p-3 item-scale">
            <div class="col-12">
                <h5 class="text-center">Itens</h5>
            </div>
            <div class="col-12">
                <a href="{{ route('full_itens') }}" class="btn btn-sm btn-outline-success border-0 float-start mb-3">Todos os Itens <i class="bi bi-card-checklist"></i></i></a>
                @if (Auth::user()->tech OR Auth::user()->admin )
                <a href="/cadastro_itens" class="btn btn-sm btn-outline-success border-0 float-end mb-3">Novo Item <i class="bi bi-plus"></i></a>
                @endif
            </div>

            <table id="itens" class="p-1 table table-responsive table-hover small" style="width:100%">
            <thead>
                <tr class="bg-success text-white">
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Modelo</th>
                    <th>Status</th>
                    <th>Etiqueta</th>
                    <th>Qtd</th>
                    <th>Categoria</th>
                    <th>Empresa</th>
                    <th>Localidade</th>
                    <th>Data Atualização</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="font-color-darkgrey">
                @foreach ($itens as $item )
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>
                        @if($item->status->descricao == "ATIVO") <i class="text-success">{{ $item->status->descricao }}</i>
                        @else
                        <i class="text-danger">{{ $item->status->descricao }}</i>
                        @endif
                    <td>{{ $item->num_ativo }}</td>
                    <td>{{ $item->qtd }}</td>
                    <td>{{ $item->categoria->descricao }}</td>
                    <td>{{ $item->empresa->razao_social }}</td>
                    <td>{{ $item->localizacaoProduto[0]->setor }}</td>
                    <td>{{ $item->updated_at->translatedFormat('l, d \d\e F, Y') }}</td>
                    <td>
                        <div class="dropdown dropstart">
                            <button class="btn btn-outline-secondary border-0" type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                <li><a class="dropdown-item" href="{{ route('item_detalhe', $item->id) }}">Detalhes <i class="bi bi-view-list float-end"></i></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Modelo</th>
                    <th>Status</th>
                    <th>Etiqueta</th>
                    <th>Qtd</th>
                    <th>Categoria</th>
                    <th>Empresa</th>
                    <th>Localidade</th>
                    <th>Data Atualização</th>
                    <th>Ação</th>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
</section>
@endsection
