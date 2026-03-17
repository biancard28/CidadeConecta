<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;

use App\Models\User;

class CidadePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->super_admin
            ? Response::allow()
            : Response::deny('Você precisa ser um administrador para acessar o conteúdo.');
    }
}
