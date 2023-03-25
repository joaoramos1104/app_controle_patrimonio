<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = ['phot_url', 'produto_id'];

    function photoProduto(){
        return $this->belongsTo(Produto::class);
    }
}
