<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

public function update(User $user, Evento $evento)
{
    return $user->id === $evento->user_id;
}

public function delete(User $user, Evento $evento)
{
    return $user->id === $evento->user_id;
}
}
