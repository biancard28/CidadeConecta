<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;
use App\Models\Cidade;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'cidade_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    // UMA CATEGORIA TEM MUITOS EVENTOS
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    // UMA CATEGORIA PERTENCE A UMA CIDADE
    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }
}
