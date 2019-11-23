<?php

namespace App;

use Illuminate\Support\Str;
use App\Helpers\EmployeeHelper;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	use EmployeeHelper;

	protected $fillable = [
		'number', 'name'
	];

	public function name()
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

}
