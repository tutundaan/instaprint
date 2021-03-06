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

    public const LATE = 1;
    public const OVERTIME = 2;

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
                return $this->recordedTime()->format('H:i') . ' (Masuk Shift 1)';
                break;

            case self::OUT:
                return $this->recordedTime()->format('H:i') . ' (Pulang Shift 1)';
                break;

            case self::OVERNIGHT_START:
                return $this->recordedTime()->format('H:i') . ' (Masuk Shift 2)';
                break;

            case self::OVERNIGHT_END:
                return $this->recordedTime()->format('H:i') . ' (Pulang Shift 2)';
                break;
        }
    }

    public static function currentDateEmployees($dateTime)
    {
        $attendances = Attendance::with(['employee'])
            ->where('duplicated', false)
            ->where('show_in_current_date', true)
            ->orderBy('employee_id')
            ->where('recorded_at', $dateTime)
            ->orderBy('recorded_time')
            ->get()
            ->groupBy(['recorded_at', function ($item) {
                return $item['employee_id'];
            }])
            ->first();

        return $attendances ?? collect([]);
    }

    public function notes()
    {
        $notes = '';

        switch($this->additional_type) {
            case self::LATE:
                $notes .= "Terlambat {$this->additional_minutes} menit";
                break;

            case self::OVERTIME:
                if ($this->additional_minutes > 60) {
                    $notes .= 'Overtime ' . date('G', mktime(0, $this->additional_minutes)) . ' jam ' . date('i', mktime(0, $this->additional_minutes)) . ' menit';
                } else {
                    $notes .= "Overtime {$this->additional_minutes} menit";
                }
                break;
        }
        return $notes;
    }

    public function evaluateAdditionalType()
    {
        $hour = $this->recordedTime()->hour()->format('i');
        $this->additional_minutes = 0;
        $this->additional_type = 0;

        if ($this->type === Attendance::IN or $this->type === Attendance::OVERNIGHT_START) {
            if ($this->type === Attendance::OVERNIGHT_START) {
                $jam = $this->recordedTime()->format('H');
                if ($jam >= 16) {
                    if ($hour > 15 and $hour <= 30) {
                        $this->additional_type = Attendance::LATE;
                        $this->score -= 50;
                        $this->additional_minutes = $hour;
                    }
                }
            } else {
                if ($hour > 15 and $hour <= 30) {
                    $this->additional_type = Attendance::LATE;
                    $this->score -= 50;
                    $this->additional_minutes = $hour;
                }
            }
        } else if ($this->type === Attendance::OUT or $this->type === Attendance::OVERNIGHT_END) {
            if($this->boundary != '23:59:59') {
                if ($this->type === Attendance::OUT) {
                    if (Carbon::parse($this->boundary)->addMinutes(15)->lessThan($this->recordedTime())) {
                        $this->additional_type = Attendance::OVERTIME;
                        $this->score += 50;
                        $this->additional_minutes = $this->recordedTime()->diffInMinutes(Carbon::parse($this->boundary));
                    }
                } else {
                    if (Carbon::parse($this->boundary)->subDay()->addMinutes(15)->lessThan($this->recordedTime())) {
                        $this->additional_type = Attendance::OVERTIME;
                        $this->score += 50;
                        $this->additional_minutes = $this->recordedTime()->diffInMinutes(Carbon::parse($this->boundary));
                    }
                }
            }
        }
    }

    public function calculateBoundary()
    {
        if ($this->type === Attendance::IN or $this->type === Attendance::OVERNIGHT_START) {
            $hour = Carbon::parse($this->recordedTime()->format('H:00:00'));

            if ($this->recordedTime()->format('i') <= 30) {
                $this->boundary = $hour->addHours(8)->format('H:00:00');
            } else {
                $this->boundary = $hour->addHours(9)->format('H:00:00');
            }

        } else if ($this->type === Attendance::OUT or $this->type === Attendance::OVERNIGHT_END) {
            if ($this->type === Attendance::OUT) {
                $attendance = Attendance::where('duplicated', false)
                    ->where('employee_id', $this->employee_id)
                    ->where('recorded_at', $this->recorded_at)
                    ->where('type', Attendance::IN)
                    ->orWhere('type', Attendance::OVERNIGHT_START)
                    ->orderBy('recorded_time')
                    ->first();
            } else {
                $yesterday = Carbon::parse($this->recorded_at)->subDay()->toDateString();

                $attendance = Attendance::where('duplicated', false)
                    ->where('employee_id', $this->employee_id)
                    ->where('recorded_at', $yesterday)
                    ->where('type', Attendance::OVERNIGHT_START)
                    ->orderBy('recorded_time')
                    ->first();
            }

            $this->boundary = ($attendance ? $attendance->boundary : '23:59:59');
        } else {
            $this->boundary = '23:59:59';
        }
    }

    public function typeLabel()
    {
        switch($this->type) {
            case self::IN:
                return 'Masuk Shift 1';
                break;

            case self::OUT:
                return 'Pulang Shift 1';
                break;

            case self::OVERNIGHT_START:
                return 'Masuk Shift 2';
                break;

            case self::OVERNIGHT_END:
                return 'Pulang Shift 2';
                break;

            case self::UNKNOWN:
                return 'Duplikat / Tidak Sah';
                break;
        }
    }

    public function additionalTypeLabel()
    {
        switch ($this->additional_type) {
            case self::LATE:
                return 'Keterlambatan';
                break;

            case self::OVERTIME:
                return 'Overtime';
                break;

            default:
                return 'Normal';
                break;
        }
    }
}
