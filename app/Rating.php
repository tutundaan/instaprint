<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'accuracy',
        'discipline',
        'skill',
        'speed',
        'teamwork',
    ];

    public function countSummary()
    {
        $this->summary = ($this->accuracy + $this->discipline + $this->skill + $this->speed + $this->teamwork) / 5;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
