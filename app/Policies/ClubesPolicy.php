<?php

namespace App\Policies;

use App\Models\Clubes;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClubesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        #return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones', 'Clubes']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clubes $clubes): bool
    {
        //
        //return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones', 'Clubes']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        //return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clubes $clubes): bool
    {
        //
        //return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones', 'Clubes']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clubes $clubes): bool
    {
        //
        //return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clubes $clubes): bool
    {
       // return $user->hasRole(['Administrador']);
	    return $user->hasRole(['Administrador', 'Federaciones']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clubes $clubes): bool
    {
        //
        return $user->hasRole(['Administrador']);
    }
}
