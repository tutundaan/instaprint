<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Attendance;
use App\AttendanceCounter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttendanceObserver
{
    public function creating(Attendance $attendance)
    {
        $carbon = Carbon::createFromFormat('d/m/Y H:i:s', $attendance->recorded_at, config('app.timezone'));
        $attendance->recorded_at = $carbon->toDateString();
        $attendance->recorded_time = $carbon->toTimeString();
        $attendance->type = Attendance::UNKNOWN;
        $attendance->days_number_in_month = 1;
        $attendance->evaluation = Attendance::UNEVALUATED;
    }

    public function created(Attendance $attendance)
    {
        $in = Attendance::where('recorded_at', $attendance->recorded_at)
                                                          ->where('employee_id', $attendance->employee_id)
                                                          ->where('type', Attendance::IN)
                                                          ->first();

        $midnight = Carbon::parse('23:00:00');
        $earlyMorning = Carbon::parse('03:00:00');
        $morningTime = Carbon::parse('06:00:00');
        $dayTime = Carbon::parse('13:00:00');
        $noonTime = Carbon::parse('16:30:00');
        $overTime = Carbon::parse('21:00:00');

        if ($attendance->recordedTime()->greaterThan($noonTime) and $attendance->recordedTime()->lessThan($overTime)) {
            $attendance->type = Attendance::OUT;
        } else if($attendance->recordedTime()->greaterThan($morningTime) and $attendance->recordedTime()->lessThan($dayTime)) {
            $attendance->type = Attendance::IN;
        } else if($attendance->recordedTime()->lessThan($earlyMorning)) {
            $attendance->type = Attendance::OVERNIGHT_END;
        } else if ($attendance->recordedTime()->lessThan($noonTime) and $attendance->recordedTime()->greaterThan($dayTime)) {
            if (!is_null($in)) {
                $attendance->type = Attendance::OUT;
            } else {
                $attendance->type = Attendance::OVERNIGHT_START;
            }
        }

        if ($attendance->evaluation == Attendance::UNEVALUATED) {
            $attendance->evaluation = Attendance::AUTOMATIC_EVALUATION;
            $attendance->save();
        }
    }
}
