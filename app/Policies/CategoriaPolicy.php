<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determina se o usuário pode editar a categoria
     */
    public function update(User $user, Categoria $categoria)
    {
        // O usuário só pode editar se pertencer à cidade da categoria
        return $user->cidades->contains($categoria->cidade_id);
    }

    /**
     * Determina se o usuário pode deletar a categoria
     */
    public function delete(User $user, Categoria $categoria)
    {
        return $user->cidades->contains($categoria->cidade_id);
    }
}
