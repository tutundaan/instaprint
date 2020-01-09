<?php

namespace App\Policies;

use App\Failure;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FailurePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any failures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the failure.
     *
     * @param  \App\User  $user
     * @param  \App\Failure  $failure
     * @return mixed
     */
    public function view(User $user, Failure $failure)
    {
        //
    }

    /**
     * Determine whether the user can create failures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the failure.
     *
     * @param  \App\User  $user
     * @param  \App\Failure  $failure
     * @return mixed
     */
    public function update(User $user, Failure $failure)
    {
        //
    }

    /**
     * Determine whether the user can delete the failure.
     *
     * @param  \App\User  $user
     * @param  \App\Failure  $failure
     * @return mixed
     */
    public function delete(User $user, Failure $failure)
    {
        //
    }

    /**
     * Determine whether the user can restore the failure.
     *
     * @param  \App\User  $user
     * @param  \App\Failure  $failure
     * @return mixed
     */
    public function restore(User $user, Failure $failure)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the failure.
     *
     * @param  \App\User  $user
     * @param  \App\Failure  $failure
     * @return mixed
     */
    public function forceDelete(User $user, Failure $failure)
    {
        //
    }

    public function link(User $user, Failure $failure)
    {
        return $user->isAdmin() and !$failure->employee_id;
    }
}
