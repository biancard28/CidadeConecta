<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = ['nome', 'uf', 'cep'];

    /**
     * Relacionamento com usuários (muitos para muitos)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'cidade_user');
        // "cidade_user" é a tabela pivot que conecta cidades e usuários
    }

    /**
     * Relacionamento com categorias
     */
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    /**
     * Relacionamento com eventos
     */
    public function eventos()
    {
        return $this->hasManyThrough(Evento::class, Categoria::class);
        // Eventos através das categorias da cidade
    }
}
