<?php

namespace App\Observers;

use App\Employee;
use Illuminate\Support\Str;

class EmployeeObserver
{
	public function creating(Employee $employee)
	{
		$employee->name = Str::lower($employee->name);
	}
}
