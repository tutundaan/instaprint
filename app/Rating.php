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

    protected $casts = [
        'evaluate' => 'float',
    ];

    public function countSummary()
    {
        $this->summary = ($this->accuracy + $this->discipline + $this->skill + $this->speed + $this->teamwork) / 5;
        $ratings = Rating::where('employee_id', $this->employee->id)
                                                     ->orderBy('created_at', 'desc')
                                                     ->get('evaluate');
        if ($ratings->count() === 0) {
            $this->evaluate = $this->summary;
        } else {
            $this->evaluate = ($ratings->first()->evaluate + $this->summary) / 2;
        }
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
