<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Attendance;

class AttendanceObserver
{
	public function creating(Attendance $attendance)
	{
		$attendance->recorded_at = Carbon::createFromFormat('d/m/Y H:i:s', $attendance->recorded_at, config('app.timezone'))->toDateTimeString();
		$attendance->type = $attendance->parseType();
		$attendance->days_number_in_month = 1;
		$attendance->additional_duration = 1000;
		$attendance->additional_type = 1;
	}
}
