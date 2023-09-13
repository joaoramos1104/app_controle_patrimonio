@extends('layouts.app')

@section('content')
<!-- Section -->
<section class="div-scale">
    <div class="container-fluid">
        <div class="row p-3">
            <div class="p-3 bg-white rounded-custom">
                <h5 class="text-center bg-success p-2 text-white rounded shadow">Relação de Itens:
                    @if (isset($itens_empresa[0]->empresa->razao_social))
                    {{ $itens_empresa[0]->empresa->razao_social }}
                    @endif
                </h5>
                <table id="itens_empresa" class="p-1 table table-responsive table-hover small" style="width:100%">
                <thead>
                    <tr class="bg-secondary text-white">
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
                    @foreach ($itens_empresa as $item )
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
                    <tr class="bg-secondary text-white">
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
    </div>
</section>
@endsection
