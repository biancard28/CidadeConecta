<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Models
use App\Models\Categoria;
use App\Models\Evento;

// Policies
use App\Policies\CategoriaPolicy;
use App\Policies\EventoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Categoria::class => CategoriaPolicy::class,
        Evento::class => EventoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Opcional: pode definir Gates adicionais aqui
        // Exemplo: Gate para verificar se usuário é super admin
        Gate::define('super-admin', function ($user) {
            return $user->super_admin;
        });
    }
}
