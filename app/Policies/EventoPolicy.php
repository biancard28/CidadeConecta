<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

    /**
     * Determina se o usuário pode editar o evento
     */
    public function update(User $user, Evento $evento)
    {
        return $user->cidades->contains($evento->cidade_id);
    }

    /**
     * Determina se o usuário pode deletar o evento
     */
    public function delete(User $user, Evento $evento)
    {
        return $user->cidades->contains($evento->cidade_id);
    }
}
