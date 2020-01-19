<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{

    public const PENDING = 1;
    public const REJECTED = 2;
    public const APPROVED = 3;

    protected $fillable = [
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
}
