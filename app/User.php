<?php

namespace App;

use App\Traits\Authorization\Blockable;
use App\Contracts\AuthorizationContract;
use Illuminate\Notifications\Notifiable;
use App\Traits\Authorization\Authorizeable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthorizationContract
{
    use Notifiable, Authorizeable, Blockable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function authorize()
    {
        return $this->role;
    }

    public function status()
    {
        return $this->is_blocked ? 'Blocked' : 'Has Access';
    }
}
