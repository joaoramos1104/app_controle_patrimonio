<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    function produtos(){
        return $this->hasMany(Produto::class);
    }

}
