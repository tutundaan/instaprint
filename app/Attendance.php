<?php

namespace App;

use Carbon\Carbon;
use App\Helpers\AttendanceHelper;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	use AttendanceHelper;

	public const IN = 1;
	public const OUT = 2;
	public const UNKNOWN = 3;
	public const LATE = 4;
	public const OVERTIME = 5;
	public const NORMAL = 6;

	protected $fillable = [
		'recorded_at',
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}
}
