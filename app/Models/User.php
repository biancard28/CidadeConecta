<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Categoria;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔹 RELACIONAMENTO: Um usuário tem várias categorias
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    // ⭐ RELACIONAMENTO COM EVENTOS
    public function eventos()
    {
        return $this->hasMany(\App\Models\Evento::class);
    }

public function cidades()
{
    return $this->belongsToMany(Cidade::class);
}
}
