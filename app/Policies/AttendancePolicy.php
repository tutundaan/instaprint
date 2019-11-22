<?php

namespace App\Policies;

use App\User;
use App\Attendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendancePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }

}
