<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Role;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if($request->nama) {
            $employees = Employee::with('user')
                ->orderBy('name')
                ->where('name', 'like', '%' . $request->nama . '%')
                ->paginate(20);

        } else {
            $employees = Employee::with('user')
                ->orderBy('name')->paginate(20);
        }

        return view('auth.employee.index', compact('employees'));
    }
}
