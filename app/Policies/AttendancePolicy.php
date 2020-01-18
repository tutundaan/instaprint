<?php

namespace App\Policies;

use App\User;
use App\Attendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendancePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin() or $user->isManager() or $user->isSupervisor();
    }

    public function view(User $user, Attendance $attendance)
    {
        return $user->isAdmin() or $user->isManager() or $user->isSupervisor();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

}
