<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FailureApiStoreRequest;
use App\Http\Resources\EmployeeRange;
use App\Http\Controllers\Controller;
use App\Employee;

class FailureController extends Controller
{
    public function store($employee, FailureApiStoreRequest $request)
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
