<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Recomendation;
use App\User;

class RecomendationPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isSupervisor();
    }

    public function delete(User $user, Recomendation $recomendation)
    {
        return $user->isSupervisor() and $recomendation->user_id == $user->id and $recomendation->deleteable();
    }

    public function update(User $user, Recomendation $recomendation)
    {
        return $user->isManager() and $recomendation->status === Recomendation::PENDING;
    }
}
