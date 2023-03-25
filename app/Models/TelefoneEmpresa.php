<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefoneEmpresa extends Model
{
    use HasFactory;
    protected $table = 'telefone_empresas';

    function telefone(){
        return $this->belongsTo(Empresa::class);
    }

    function empresas(){
        return $this->hasMany(Telefone::class);
    }
}
