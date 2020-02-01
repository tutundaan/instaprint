<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Employee as EmployeeResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with([
            'ratings',
            'failures',
            'attendances',
        ])->orderBy('name')->paginate(20);

        return EmployeeResource::collection($employees);
    }
}
