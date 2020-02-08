<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rating extends Model
{
    protected $fillable = [
        'accuracy',
        'discipline',
        'skill',
        'speed',
        'teamwork',
        'created_at',
        'updated_at',
        'user_id',
        'employee_id',
    ];

    protected $casts = [
        'evaluate' => 'float',
    ];

    public function countSummary()
    {
        $this->summary = ($this->accuracy + $this->discipline + $this->skill + $this->speed + $this->teamwork) / 5;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdAt()
    {
        return Carbon::parse($this->created_at);
    }
}
