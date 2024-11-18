<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StuLink;

class STUPolicy
{
    public function before($user, $ability)
    {
        if ($user->hasRole('admin') || $user->hasRole('super-admin')){
            return true;
        }
    }

      /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_all_stu');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, STULink $STULink): bool
    {
        return $user->can('view_own_stu') && $user->id == $STULink->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_stu');
    }

    /**
     * Determine whether the user can update any models.
     */
    public function updateAny(User $user): bool
    {
        return $user->can('edit_all_stu');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, STULink $STULink): bool
    {
        return $user->can('edit_own_stu') && $user->id == $STULink->user_id;
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_all_stu');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, STULink $STULink): bool
    {
        return $user->can('delete_own_stu') && $user->id == $STULink->user_id;
    }
}
