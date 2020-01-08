<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Role;
use Alert;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

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

    public function update(Employee $employee, EmployeeUpdateRequest $request)
    {
        $employee->update($request->validated());

        Alert::toast('Berhasil mengubah Karyawan', 'success');

        return redirect()->back();
    }
}
