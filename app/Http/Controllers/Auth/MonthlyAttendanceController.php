<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Excel;
use Alert;
use App\User;
use App\Attendance;
use App\Http\Controllers\Controller;
use App\Imports\MonthlyAttendanceImport;
use App\Imports\FetchEmployeeFromMonthlyAttendanceImport;
use App\Http\Requests\Auth\MonthlyAttendanceStoreRequest;

class MonthlyAttendanceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Attendance::class, 'attendance');
    }

    public function index()
    {
        $attendances = Attendance::with(['employee'])
            ->get()
            ->groupBy(['recorded_at', function ($item) {
                return $item['employee_id'];
            }]);

    	return view('auth.monthly-attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('auth.monthly-attendance.create');
    }

    public function store(MonthlyAttendanceStoreRequest $request)
    {
        $file = $request->validated()['attendance'];

        Excel::import(new FetchEmployeeFromMonthlyAttendanceImport, $file);
        Excel::import(new MonthlyAttendanceImport, $file);

        Alert::toast('Berhasil import Data Absen Bulanan', 'success');

        return redirect()->back();
    }
}
