<?php

namespace App\Imports;

use App\Employee;
use App\Attendance;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FetchEmployeeFromMonthlyAttendanceImport implements ToModel
{

    public function model(array $row)
    {
		if (!isset($row[0])) {
			return null;
		}

        
    }
}
