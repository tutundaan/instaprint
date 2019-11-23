<?php

namespace App\Imports;

use App\Employee;
use App\Attendance;
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

        $employee = Employee::whereNumber($row[2])->firstOrFail();

        return $employee->attendances()->save(
            new Attendance([
                'recorded_at' => $row[3],
            ])
        );
    }
}
