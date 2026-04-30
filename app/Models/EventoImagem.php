<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoImagem extends Model
{
    protected $table = 'evento_imagens';

    protected $fillable = [
        'evento_id',
        'imagem'
    ];
}
