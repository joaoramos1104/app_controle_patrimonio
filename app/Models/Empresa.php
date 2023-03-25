<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';

    function endereco(){
        return $this->hasMany(Endereco::class);
    }

    function produtoEmpresa(){
        return $this->hasMany(Produto::class);
    }

    function contato(){
        return $this->hasMany(Contato::class);
    }

    function teste()
    {
    //     DB::table('empresas')
    //     ->join('produtos', 'produtos.empresa_id', '=', 'empresas.id')
    //     ->select('empresas.razao_social', DB::raw("SUM(produtos.valor) as total"))
    //     ->groupBy('empresas.razao_social')
    //     ->get();
    }

}
