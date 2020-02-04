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
        $paginate = Employee::count();
        $employees = Employee::with([
            'ratings',
            'ratings.user',
            'failures',
            'attendances',
            'user',
            'user.role',
        ])->orderBy('name')->paginate($paginate);

        return EmployeeResource::collection($employees);
    }
}
