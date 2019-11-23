<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	public const IN = 1;
	public const OUT = 2;
	public const UNKNOWN = 3;
	public const Late = 4;
	public const OVERTIME = 5;
	public const NORMAL = 6;

	protected $fillable = [
		'recorded_at',
	];

	public function recordedAt()
	{
		return Carbon::parse($this->recorded_at);
	}

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
			return self::Late;
		}

		return self::NORMAL;
	}

	public function isLate()
	{
		if ($this->type == self::IN) {
			$border = Carbon::parse($this->recordedAt()->startOfday()->toDateString() . " " . config('instaprint.jam_masuk.batas_tengah'));

			return $this->recordedAt()->greaterThan($border);
		}

		return false;
	}

	public function aroundOverTime()
	{
	}

	public function aroundInTime()
	{
		$start = Carbon::parse($this->recordedAt()->startOfday()->toDateString() . " " . config('instaprint.jam_masuk.batas_atas'));
		$border = Carbon::parse($this->recordedAt()->startOfday()->toDateString() . " " . config('instaprint.jam_masuk.batas_bawah'));

		return $this->recordedAt()->between($start, $border);
	}

	public function aroundOutTime()
	{
		$start = Carbon::parse($this->recordedAt()->startOfday()->toDateString() . " " . config('instaprint.jam_keluar.batas_atas'));
		$border = Carbon::parse($this->recordedAt()->startOfday()->toDateString() . " " . config('instaprint.jam_keluar.batas_bawah'));

		return $this->recordedAt()->between($start, $border);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}
}
