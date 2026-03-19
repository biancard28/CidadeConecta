<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cidade;
use Illuminate\Auth\Access\HandlesAuthorization;

class CidadePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Cidade $cidade)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Cidade $cidade)
    {
        return true; // 🔥 libera editar
    }

    public function delete(User $user, Cidade $cidade)
    {
        return true; // 🔥 libera excluir
    }
}
