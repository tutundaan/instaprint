<?php

namespace App\Policies;

use App\Failure;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FailurePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin() or $user->isSupervisor() or $user->isManager();
    }

    public function view(User $user, Failure $failure)
    {
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Failure $failure)
    {
    }

    public function delete(User $user, Failure $failure)
    {
    }

    public function restore(User $user, Failure $failure)
    {
    }

    public function forceDelete(User $user, Failure $failure)
    {
    }

    public function link(User $user, Failure $failure)
    {
        return ($user->isAdmin() or $user->isSupervisor()) and !$failure->employee_id ;
    }

    public function relink(User $user, Failure $failure)
    {
        return ($user->isAdmin() or $user->isSupervisor()) and $failure->employee_id ;
    }

    public function unlink(User $user, Failure $failure)
    {
        return ($user->isAdmin() or $user->isSupervisor()) and $failure->employee_id ;
    }
}
