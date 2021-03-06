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
        $rating = $this->ratings()
                    ->orderBy('created_at', 'desc')
                    ->first();

        if (!$rating) {
            return new Rating([
                'accuracy' => 0,
                'discipline' => 0,
                'skill' => 0,
                'speed' => 0,
                'teamwork' => 0,
            ]);
        }

        $rate = new Rating([
            'accuracy' => ($this->ratings->sum('accuracy') / $this->ratings->count()),
            'discipline' => ($this->ratings->sum('discipline') / $this->ratings->count()),
            'skill' => ($this->ratings->sum('skill') / $this->ratings->count()),
            'speed' => ($this->ratings->sum('speed') / $this->ratings->count()),
            'teamwork' => ($this->ratings->sum('teamwork') / $this->ratings->count()),
        ]);

        $rate->id = $rating->id;
        $rate->evaluate = $rating->evaluate;
        $rate->created_at = $rating->created_at;
        $rate->user()->associate($rating->user);

        return $rate;
    }

    public function lastSupervisorRating()
    {
        return $this->ratings()
                    ->where('user_id', Auth::user()->id)
                    ->where('created_at', 'like', now()->format('Y-m-') . '%')
                    ->first();
    }

    public function hasNoPendingRecomendation()
    {
        return !$this->pendingRecomendation();
    }

    public function hasPendingRecomendation()
    {
        return !!$this->pendingRecomendation();
    }

    public function hasOpenRecomendation()
    {
        return !!$this->openRecomendation();
    }

    public function hasNoOpenRecomendation()
    {
        return !$this->openRecomendation();
    }

    public function pendingRecomendation()
    {
        return $this->recomendations()
                    ->where('created_at', 'like', now()->format('Y-m-') . '%')
                    ->where('status', Recomendation::PENDING)
                    ->first();
    }

    public function openRecomendation()
    {
        return $this->recomendations()
                    ->where('created_at', 'like', now()->format('Y-m-') . '%')
                    ->whereIn('status', [Recomendation::PENDING, Recomendation::APPROVED, Recomendation::REJECTED])
                    ->first();
    }

    public function calculateRating()
    {
        $rating = $this->lastRating();

        $targetRating = Rating::find($rating->id);

        $targetRating->evaluate = $this->ratings->sum('summary') / $this->ratings->count();
        $targetRating->save();
    }

    public function failureRangeLink()
    {
        return route('api.failure.store', $this);
    }

    public function attendanceRangeLink()
    {
        return route('api.attendance.store', $this);
    }
}
