<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttendanceApiStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeRange;
use App\Employee;

class AttendanceController extends Controller
{
    public function store($employee, AttendanceApiStoreRequest $request)
    {
        $employees = Employee::with([
            'ratings',
            'ratings.user',
            'failures',
            'attendances',
            'user',
            'user.role',
        ])->findOrFail($employee);

        return new EmployeeRange($employees, $request->start, $request->end);
    }
}
