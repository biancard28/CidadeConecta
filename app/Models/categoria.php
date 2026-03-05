<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tipo'
    ];

    // 👇 UMA CATEGORIA TEM MUITOS EVENTOS
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
