<?php

namespace App\Imports;

use App\Employee;
use App\Attendance;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MonthlyAttendanceImport implements ToModel
{

    public function model(array $row)
    {
    	if ($row[0] === 'Departemen') {
    		return null;
    	}

		if (!isset($row[0])) {
			return null;
		}

    	try {
    		$employee = Employee::whereNumber($row[2])->firstOrFail();
    	} catch (ModelNotFoundException $e) {
    		return new Employee([
    			'number' => $row[2],
    			'name' => Str::title($row[1]),
    		]);
    	}
    }
}
