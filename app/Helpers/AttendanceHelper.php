<?php 

namespace App\Helpers;

use Carbon\Carbon;
use App\Attendance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait AttendanceHelper {
	
	public function parseType()
	{
		if ($this->aroundInTime()) {
			return self::IN;
		}

		if ($this->aroundOutTime()) {
			return self::OUT;
		}

		return self::UNKNOWN;
	}

	public function parseAdditionalType()
	{
		if ($this->isLate()) {
			return self::LATE;
		}

		return self::NORMAL;
	}

	public function isLate()
	{
		if ($this->type == self::IN) {
			$middle = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_masuk.nilai'));
			$border = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_masuk.batas_tengah'));

			if ($this->recordedDateTime()->greaterThan($border)) {
				$this->additional_duration = $this->recordedDateTime()->diffInSeconds($middle);
				return true;
			}
		}

		return false;
	}

	public function aroundInTime()
	{
		$start = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_masuk.batas_atas'));
		$border = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_masuk.batas_bawah'));

		return $this->recordedDateTime()->between($start, $border);
	}

	public function aroundOutTime()
	{
		$start = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_keluar.batas_atas'));
		$border = Carbon::parse($this->recorded_at . " " . config('instaprint.jam_keluar.batas_bawah'));

		return $this->recordedDateTime()->between($start, $border);
	}

	public function getInAttendanceTime()
	{
		try {
			$row = $this->searchCorrespondAttendance(self::IN);
			return $row->recordedDateTime()->format('H:i');

		} catch (ModelNotFoundException $e) {
			if ($this->type == self::IN) {
				return $this->recordedDateTime()->format('H:i');
			}

			return '-';
		}
	}

	public function getInAttendanceObject()
	{
		try {
			return $this->searchCorrespondAttendance(self::IN);
		} catch (ModelNotFoundException $e) {
			if ($this->type == self::IN) {
				return $this;
			}

			return null;
		}
	}

	public function getOutAttendanceObject()
	{
		try {
			return $this->searchCorrespondAttendance(self::OUT);
		} catch (ModelNotFoundException $e) {
			if ($this->type == self::OUT) {
				return $this;
			}

			return null;
		}
	}

	public function getOutAttendanceTime()
	{
		try {
			$row = $this->searchCorrespondAttendance(self::OUT);
			return $row->recordedDateTime()->format('H:i');

		} catch (ModelNotFoundException $e) {
			if ($this->type == self::OUT) {
				return $this->recordedDateTime()->format('H:i');
			}

			return '-';
		}
	}

	public function additionalDuration()
	{
		$object = $this->getInAttendanceObject();

		if ($object) {
			if ($object->additional_type == self::LATE) {
				return gmdate('i.s', $object->additional_duration) . " menit";
			}
		}

		return '-';
	}

	private function searchCorrespondAttendance(int $type)
	{
		return self::whereEmployeeId($this->employee_id)
				->whereType($type)
				->whereRecordedAt($this->recorded_at)
				->orderBy('recorded_at', 'asc')
				->firstOrFail();;
	}

	public function recordedDateTime()
	{
		return Carbon::parse("{$this->recorded_at} {$this->recorded_time}");
	}

}