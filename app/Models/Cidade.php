<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Cidade extends Model
{
    protected $fillable = [
        'nome',
        'uf',
        'cep',
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
}
