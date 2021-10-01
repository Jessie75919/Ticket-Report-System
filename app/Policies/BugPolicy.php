<?php

namespace App\Policies;

use App\Models\Bug;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BugPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bug $bug)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isRoleOf(Role::QA);
    }

    /**
     * Determine whether the user can update the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bug $bug)
    {
        return $user->isRoleOf(Role::QA) && $bug->created_user_id === $user->id;
    }

    public function mark(User $user, Bug $bug)
    {
        if($bug->status === Bug::STATUS_PENDING) {
            return $user->isRoleOf(Role::RD);
        }

        return $user->isRoleOf(Role::RD) &&
            $bug->resolved_user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bug $bug)
    {
        return $user->isRoleOf(Role::QA) && $bug->created_user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bug $bug)
    {
        return $bug->created_user_id === $user->id ||
            $bug->resolved_user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bug $bug)
    {
        return $user->isRoleOf(Role::QA) && $bug->created_user_id === $user->id;
    }
}
