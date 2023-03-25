<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';

    function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    function images(){
        return $this->hasMany(Photo::class);
    }

    function localizacaoProduto(){
        return $this->hasMany(Localizacao::class);
    }

    function status(){
        return $this->belongsTo(Status::class);
    }

    function condicao(){
        return $this->belongsTo(Condicao::class);
    }

}
