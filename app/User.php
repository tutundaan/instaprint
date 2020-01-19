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
        'name', 'phone', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'phone';
    }

    public function avatar()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->phone);
    }

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

    public function employee()
    {
        if ($this->isEmployee()) {
            return $this->hasOne(Employee::class);
        }

        throw new \BadMethodCallException("Non employee role cannot link account");
    }

    public function recomendations()
    {
        return $this->hasMany(Recomendation::class);
    }

    public function approves()
    {
        return $this->hasMany(Recomendation::class, 'approved_by_id');
    }
}
