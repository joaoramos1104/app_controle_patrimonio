@extends('layouts.app')

@section('content')


<!-- Section -->
<section>
    <div class="container-fluid home-scale">
        <div class="row p-3">
            <div class="col-md-3 col-sm-12 p-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body font-color-darkgrey border-left-success">
                        <h6 class="card-title">Total de Itens <i class="bi bi-card-checklist float-end"></i></h6>
                        <div class="row grad-success rounded shadow p-1">
                            <div class="col-5" id="count_total_itens">
                            </div>
                            <div class="col-7">
                                <div class="p-1">
                                    <a href="{{ route('itens') }}" class="btn btn-sm btn-outline-secondary border-0 float-end m-1">Ver Intens</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 p-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body font-color-darkgrey border-left-info">
                        <h6 class="card-title">Categorias<i class="bi bi-list-check float-end"></i></h6>
                        <div class="row grad-info rounded shadow p-1">
                            <div class="col-6" id="count_categorias">
                            </div>
                            <div class="col-6">
                                <div class="p-1">
                                    <a href="{{ route('categorias') }}" class="btn btn-sm btn-outline-secondary border-0 float-end m-1">Ver Categorias</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 p-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body font-color-darkgrey border-left-warning">
                        <h6 class="card-title">Itens Inativos <i class="bi bi-list-ul float-end"></i></h6>
                        <div class="row grad-warning rounded shadow p-1">
                            <div class="col-6" id="count_itens_inativos">
                            </div>
                            <div class="col-6">
                                <div class="p-1">
                                    <a href="{{ route('itens_inativos') }}" class="btn btn-sm btn-outline-secondary border-0 float-end m-1">Ver Inativos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 p-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body font-color-darkgrey border-left-secondary">
                        <h6 class="card-title">Empresas / Clientes <i class="bi bi-person-vcard float-end"></i></h6>
                        <div class="row grad-grey rounded shadow p-1">
                            <div class="col-6" id="count_empresas">
                            </div>
                            <div class="col-6">
                                <div class="p-1">
                                    <a href="{{ route('empresas') }}" class="btn btn-sm btn-outline-secondary border-0 float-end m-1">Ver Empresas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-md-7 col-sm-12 p-3">
                <canvas class="bg-white rounded-custom shadow p-3" id="valorCategoria" width="800" height="450"></canvas>
            </div>
            <div class="col-md-5 col-sm-12 p-3">
                <canvas class="bg-white rounded-custom shadow p-3" id="itensCategoria" width="800" height="640"></canvas>
            </div>
        </div>


        <div class="row p-1">
            <div class="col-md-4 col-sm-12">
                <div id="categorias" class="card p-2 border-0 bg-transparent">
                <h6 class="p-2 bg-white shadow rounded-2">Categorias <i class="bi bi-list-check float-end"></i></h6>
                    <ul id="categorias_home" class="list-group list-group-flush scroll-list-group">
                    </ul>
                </div>
                <div id="clientes" class="card p-2 mt-2 border-0 bg-transparent">
                    <h6 class="p-2 bg-white shadow rounded-2">Empresas / Clientes <i class="bi bi-people float-end"></i></h6>
                    <ul id="empresas_home" class="list-group list-group-flush scroll-list-group">
                    </ul>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 p-3">
                <canvas class="bg-white rounded-custom shadow p-3" id="valorEmpresas" width="800" height="450"></canvas>
            </div>
        </div>

    </div>
</section>

<script>

</script>
@endsection
