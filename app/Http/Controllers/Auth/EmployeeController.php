<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\EmployeeLinkStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Failure;
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

        $failures = Failure::whereNull('employee_id')->distinct()->get('holder');

        return view('auth.employee.index', compact('employees', 'failures'));
    }

    public function update(Employee $employee, EmployeeUpdateRequest $request)
    {
        $employee->update($request->validated());

        Alert::toast('Berhasil mengubah Karyawan', 'success');

        return redirect()->back();
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        Alert::toast('Berhasil menghapus Karyawan', 'success');
        return redirect()->back();
    }

    public function link(Employee $employee, EmployeeLinkStoreRequest $request)
    {
        $failure = Failure::where('holder', $request->holder)->first();
        $failure->linkEmployee($employee);

        Alert::success('Berhasil menautkan Karyawan dengan SPK');
        return redirect()->back();
    }
}
