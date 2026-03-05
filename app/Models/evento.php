<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id', // 👈 corrigido
        'nome',
        'descricao',
        'local',
        'data',
        'horario',
        'recorrencia'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 👇 RELAÇÃO COM CATEGORIA
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
