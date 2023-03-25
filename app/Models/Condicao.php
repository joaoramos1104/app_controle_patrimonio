<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condicao extends Model
{

    use HasFactory;
    protected $table = 'condicoes';

    function produtoCondicao(){
        return $this->hasMany(Produto::class);
    }
}
