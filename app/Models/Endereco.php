<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $table = 'enderecos';
    protected $fillable = ['cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'uf'];

    function empresaEmdereco(){
        return $this->hasMany(Empresa::class);
    }
}
