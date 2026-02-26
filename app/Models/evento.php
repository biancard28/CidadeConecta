<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'local',
        'data',
        'horario',
        'recorrencia',
        'id_categoria'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
