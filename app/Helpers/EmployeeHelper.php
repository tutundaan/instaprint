<?php 

namespace App\Helpers;

use Carbon\Carbon;
use App\AttendanceCounter;

trait EmployeeHelper {
	
	public function incrementCounter(string $date)
	{

		if (!$this->hasCounter($date)) {
			return $this->attendanceCounters()->create(['date' => $date]);
		}

		$counter = $this->currentCounter($date);

		return $counter->date == $date ? $counter : $this->updateCounter($counter, $date);
	}

	public function currentCounter(string $date)
	{
		$carbon = Carbon::parse($date);

		return $this->attendanceCounters()
			->where('date', 'like', $carbon->format('Y-m-%'))
			->first();
	}

	public function hasCounter(string $date)
	{
		return $this->currentCounter($date) instanceof AttendanceCounter;
	}

	public function updateCounter(AttendanceCounter $counter, string $date)
	{
		$counter->update([
			'date' => $date,
		]);

		$counter->increment('number');

		return $counter;
	}

}