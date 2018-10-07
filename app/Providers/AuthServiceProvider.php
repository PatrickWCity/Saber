<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('esAdmin', function ($user) {
            return $user->tienePerfil('Administrador');
        });

        Gate::define('esDev', function ($user) {
            return $user->tienePerfil('Desarrollador');
        });

        Gate::define('esAutor', function ($user) {
            return $user->tienePerfil('Autor');
        });

        Gate::define('esUsuario', function ($user) {
            return $user->tienePerfil('Usuario');
        });

        Gate::define('esVoluntario', function ($user) {
            return $user->tienePerfil('Voluntario');
        });

        Gate::define('esParticipante', function ($user) {
            return $user->tienePerfil('Participante');
        });

        Gate::define('esSuscriptor', function ($user) {
            return $user->tienePerfil('Suscriptor');
        });

        Gate::define('esOrganizador', function ($user) {
            return $user->tienePerfil('Organizador');
        });
        
        Passport::routes();
    }
}
