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

    public function status()
    {
        switch($this->status) {
            case self::PENDING:
                return 'Pending';
                break;

            case self::REJECTED:
                return 'Ditolak';
                break;

            case self::APPROVED:
                return 'Diterima';
                break;
        }
    }

    public function deleteable()
    {
        return $this->status !== self::APPROVED;
    }
}
