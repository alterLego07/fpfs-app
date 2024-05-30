<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Categorias'                     => 'App\Policies\CategoriasPolicy',
        'App\Models\Permissions'                    => 'App\Policies\PermissionPolicy',
        'App\Models\Clubes'                         => 'App\Policies\ClubesPolicy',
        'App\Models\ClubesUsuarios'                 => 'App\Policies\ClubesUsuariosPolicy',
        'App\Models\Nacionalidades'                 => 'App\Policies\NacionalidadPolicy',
        'App\Models\Role'                           => 'App\Policies\RolePolicy',
        'App\Models\Departamentos'                  => 'App\Policies\DepartamentosPolicy',
        'App\Models\Federaciones'                   => 'App\Policies\FederacionesPolicy',
        'App\Models\FederacionesUsuarios'           => 'App\Policies\FederacionesUsuariosPolicy',
        'App\Models\User'                           => 'App\Policies\UserPolicy',
        'App\Models\Jugadores'                      => 'App\Policies\JugadoresPolicy',
        'App\Models\Ciudades'                       => 'App\Policies\CiudadesPolicy',
        'App\Models\Tipo_documentos'                 => 'App\Policies\TipoDocumentosPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}
