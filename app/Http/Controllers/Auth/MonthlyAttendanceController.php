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

        $class = Attendance::class;
        $attendances = Attendance::with(['employee'])
            ->orderBy('recorded_at', 'desc')
            ->get()
            ->groupBy(['recorded_at', function ($item) {
                return $item['employee_id'];
            }]);

    	return view('auth.monthly-attendance.index', compact('attendances', 'class'));
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

        $attendances = Attendance::currentDateEmployees($dateTime);

        if ($attendances->count() == 0) {
            return abort(404);
        }

        return view('auth.monthly-attendance.show', compact('attendances'));
    }
}
