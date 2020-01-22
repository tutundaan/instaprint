<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Excel;
use Alert;
use App\User;
use Carbon\Carbon;
use App\Attendance;
use App\Http\Controllers\Controller;
use App\Imports\MonthlyAttendanceImport;
use App\Imports\FetchEmployeeFromMonthlyAttendanceImport;
use App\Http\Requests\Auth\MonthlyAttendanceStoreRequest;

class MonthlyAttendanceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Attendance::class);

        $attendances = Attendance::with(['employee'])
            ->get()
            ->groupBy(['recorded_at', function ($item) {
                return $item['employee_id'];
            }]);

    	return view('auth.monthly-attendance.index', compact('attendances'));
    }

    public function create()
    {
        $this->authorize('create', Attendance::class);

        return view('auth.monthly-attendance.create');
    }

    public function store(MonthlyAttendanceStoreRequest $request)
    {
        $this->authorize('create', Attendance::class);

        $file = $request->validated()['attendance'];

        Excel::import(new FetchEmployeeFromMonthlyAttendanceImport, $file);
        Excel::import(new MonthlyAttendanceImport, $file);

        Alert::success('Berhasil import Data Absen Bulanan');

        return redirect()->route('auth.monthly-attendance.index');
    }

    public function show($dateTime)
    {
        $this->authorize('view', Attendance::class);

        $attendance = Attendance::with(['employee']);
        $attendances = Attendance::with(['employee'])
            ->orderBy('employee_id')
            ->where('recorded_at', $dateTime)
            ->orderBy('recorded_time')
            ->get()
            ->groupBy(['recorded_at', function ($item) {
                return $item['employee_id'];
            }])
            ->first();

        return view('auth.monthly-attendance.show', compact('attendances','attendance'));
    }
}
