<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
        $user->api_token = Str::random(86);
    }

    public function updating(User $user)
    {
        // $user->password = bcrypt($user->password);
    }
}
