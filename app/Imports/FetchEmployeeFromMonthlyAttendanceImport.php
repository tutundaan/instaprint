<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FetchEmployeeFromMonthlyAttendanceImport implements ToModel
{

    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }

        if($row[0] !== 'Departemen' and $row[0] !== 'IN8TAPRINT') {
            return abort(403, 'Format Excel salah');
        }

    	if ($row[0] === 'Departemen') {
            return null;
    	}

    	try {
            $employee = Employee::whereNumber($row[2])->firstOrFail();
    	} catch (ModelNotFoundException $e) {
            return new Employee([
                'number' => $row[2],
                'name' => $row[1],
            ]);
    	}
    }
}
