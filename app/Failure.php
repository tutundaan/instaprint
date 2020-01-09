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
}
