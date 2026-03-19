<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'cidade_id'
    ];

    // RELAÇÃO COM EVENTOS
    public function eventos()
    {
        return $this->hasMany(\App\Models\Evento::class);
    }

    // RELAÇÃO COM CIDADE
    public function cidade()
    {
        return $this->belongsTo(\App\Models\Cidade::class);
    }
}
