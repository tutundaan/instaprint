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

        $carbon = Carbon::parse($dateTime);
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

        if (is_null($attendances)) {
            return abort(404);
        }

        foreach ($attendances as $attendance) {
            $in = null;

            foreach ($attendance as $item) {
                $midnight = Carbon::parse('23:00:00');
                $earlyMorning = Carbon::parse('03:00:00');
                $morningTime = Carbon::parse('06:00:00');
                $dayTime = Carbon::parse('13:00:00');
                $noonTime = Carbon::parse('16:30:00');
                $overTime = Carbon::parse('21:00:00');

                if ($item->recordedTime()->greaterThan($noonTime) and $item->recordedTime()->lessThan($overTime)) {
                    $item->type = Attendance::OUT;
                } else if($item->recordedTime()->greaterThan($morningTime) and $item->recordedTime()->lessThan($dayTime)) {
                    $item->type = Attendance::IN;
                    $in = $item->recordedTime();
                } else if($item->recordedTime()->lessThan($earlyMorning)) {
                    $item->type = Attendance::OVERNIGHT_END;
                } else if ($item->recordedTime()->lessThan($noonTime) and $item->recordedTime()->greaterThan($dayTime)) {
                    if (!is_null($in)) {
                        $item->type = Attendance::OUT;
                    } else {
                        $item->type = Attendance::OVERNIGHT_START;
                    }
                }

                if ($item->evaluation == Attendance::UNEVALUATED) {
                    $item->evaluation = Attendance::AUTOMATIC_EVALUATION;
                    $item->save();
                }
            }

            $in = null;
        }

        return view('auth.monthly-attendance.show', compact('attendances', 'carbon', 'attendance'));
    }
}
