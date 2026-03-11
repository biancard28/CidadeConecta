<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\User;

class Cidade extends Model
{
    protected $table = 'cidades';

    protected $fillable = [
        'nome',
        'uf',
        'cep',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    // UMA CIDADE TEM VÁRIAS CATEGORIAS
    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'cidade_id');
    }

    // UMA CIDADE PODE TER VÁRIOS USUÁRIOS AUTORIZADOS (se você estiver usando isso)
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'cidade_user', 'cidade_id', 'user_id');
    }
}
