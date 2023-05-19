<?php

namespace App\Policies;

use App\Models\User;

class SettingsPolicy
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
    public function view(User $user): bool
    {
        $user->can('view settings');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $user->can('edit settings');
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('delete settings');
    }
}
