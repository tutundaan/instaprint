<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\EmployeeHelper;
use Illuminate\Support\Str;
use Auth;

class Employee extends Model
{
    use EmployeeHelper;

    protected $fillable = [
            'number', 'name'
    ];

    public function formattedName()
    {
            return Str::title($this->name);
    }

    public function attendances()
    {
            return $this->hasMany(Attendance::class);
    }

    public function attendanceCounters()
    {
            return $this->hasMany(AttendanceCounter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function failures()
    {
        return $this->hasMany(Failure::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orderedRatings()
    {
        return $this->ratings()->orderBy('created_at', 'desc');
    }

    public function recomendations()
    {
        return $this->hasMany(Recomendation::class);
    }

    public function rating()
    {
        return $this->lastRating()->evaluate ?? null;
    }

    public function lastRating()
    {
        return $this->ratings()
                    ->orderBy('created_at', 'desc')
                    ->first();
    }

    public function lastSupervisorRating()
    {
        return $this->ratings()
                    ->where('user_id', Auth::user()->id)
                    ->where('created_at', 'like', now()->toDateString() . '%')
                    ->first();
    }
}
