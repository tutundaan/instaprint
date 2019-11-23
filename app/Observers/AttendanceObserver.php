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
		$attendance->type = $attendance->parseType();
		$attendance->days_number_in_month = 1;
		$attendance->additional_type = $attendance->parseAdditionalType();
	}

	public function created(Attendance $attendance)
	{
		$attendance->employee->incrementCounter($attendance->recorded_at);

		$counter = $attendance->employee->currentCounter($attendance->recorded_at);

		$attendance->days_number_in_month = $counter->number;
		$attendance->save();
	}
}
