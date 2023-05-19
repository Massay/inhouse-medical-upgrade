<?php

namespace App\Policies;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $user->can('view partners');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clinic $partner): bool
    {
        $user->can('view partners');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $user->can('create partners');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clinic $partner): bool
    {
        $user->can('edit partners');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clinic $partner): bool
    {
        $user->can('delete partners');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clinic $partner): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clinic $partner): bool
    {
        //
    }
}
