<?php 

namespace App\Helpers;

use Carbon\Carbon;
use App\Attendance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait AttendanceHelper {
	
    public function earlyMorning()
    {
        return $this->recordedTime()->lessThan(Carbon::parse('03:00:00'));
    }

    public function overnightTime()
    {
        $dayTime = Carbon::parse('12:00:00');
        $noonTime = Carbon::parse('16:00:00');

        return $this->recordedTime()->greaterThan($dayTime) and $this->recordedTime()->lessThan($noonTime);
    }

    public function recordedTime()
    {
        return Carbon::parse($this->recorded_time);
    }

    public function recordedAt()
    {
        return Carbon::parse($this->recorded_at);
    }

    public function noonTime()
    {
        $noonTime = Carbon::parse('16:00:00');
        return $noonTime->lessThan($this->recordedTime());
    }
}
