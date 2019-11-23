<?php

namespace App\Observers;

use App\AttendanceCounter;

class AttendanceCounterObserver
{
	public function creating(AttendanceCounter $attendanceCounter)
	{
		if (!$attendanceCounter->number) {
			$attendanceCounter->number = 1;
		}
	}
}
