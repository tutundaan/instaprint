<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $model)
    {
        return $user == $model;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $model)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, User $model)
    {
        return $user->isAdmin();
    }

    public function block(User $user, User $model)
    {
        return $model->ableToChangeUserStatus($user);
    }

    public function unblock(User $user, User $model)
    {
        return $model->ableToChangeUserStatus($user);
    }

    public function changePassword(User $user, User $model)
    {
        return $user == $model;
    }
}
