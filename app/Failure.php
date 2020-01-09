<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Failure extends Model
{
    protected $fillable = [
        'number',
        'holder',
        'subtotal',
        'discount',
        'tax',
        'freight',
        'total',
        'paid',
        'signed',
        'rating',
        'note',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function relatedEmployee()
    {
        $array = explode(' ', $this->holder);

        $query = Employee::where('name', 'like', strtolower("%{$array[0]}%"));

        foreach($array as $value) {
            $value != 0 ? $query->orWhere('name', 'like', strtolower("%{$value}%")) : null;
        }

        return $query->get();
    }
}
