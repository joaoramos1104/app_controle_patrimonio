<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    use HasFactory;
    protected $table = 'localizacoes';
    protected $fillable = ['bloco', 'andar', 'setor', 'produto_id'];

    function produtoLocalizacao(){
        return $this->hasMany(Produto::class);
    }
}
