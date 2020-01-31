<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = [
        'date',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->toDateString();
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

    public function linkEmployee(Employee $employee)
    {
        return Failure::whereNull('employee_id')
            ->where('holder', $this->holder)
            ->update([
                'employee_id' => $employee->id
            ]);
    }

    public function relinkEmployee(Employee $employee)
    {
        return Failure::where('employee_id', $this->employee_id)
            ->where('holder', $this->holder)
            ->update([
                'employee_id' => $employee->id,
            ]);
    }

    public function unlink()
    {
        return Failure::where('holder', $this->holder)
                                          ->where('employee_id', $this->employee_id)
                                          ->update([
                                              'employee_id' => null
                                          ]);
    }
}
