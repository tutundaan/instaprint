<?php

namespace App\Policies;

use App\Employee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Employee $employee)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Employee $employee)
    {
        return ($user->isAdmin() or $user->isSupervisor() or $user->isManager()) and !$employee->user;
    }

    public function delete(User $user, Employee $employee)
    {
        return $user->isAdmin() and !$employee->user;
    }

    public function restore(User $user, Employee $employee)
    {
    }

    public function forceDelete(User $user, Employee $employee)
    {
    }

    public function link(User $user, Employee $employee)
    {
        return $user->isAdmin();
    }
}
