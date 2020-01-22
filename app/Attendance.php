<?php

namespace App;

use Carbon\Carbon;
use App\Helpers\AttendanceHelper;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use AttendanceHelper;

    public const UNKNOWN = 0;
    public const IN = 1;
    public const OUT = 2;
    public const OVERNIGHT_START = 3;
    public const OVERNIGHT_END = 4;

    public const UNEVALUATED = 0;
    public const AUTOMATIC_EVALUATION = 1;
    public const MANUAL_EVALUATION = 2;

    protected $fillable = [
        'recorded_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function evaluation()
    {
        return $this->evaluation === self::AUTOMATIC_EVALUATION ? 'Evaluasi Otomatis' : 'Evaluasi Manual';
    }

    public function timeStatus()
    {
        switch($this->type) {
            case self::IN:
                return '(Masuk)';
                break;

            case self::OUT:
                return '(Pulang)';
                break;

            case self::OVERNIGHT_START:
                return '(Lembur Masuk)';
                break;

            case self::OVERNIGHT_END:
                return '(Lembur Pulang)';
                break;
        }
    }
}
