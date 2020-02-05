<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rank;
use App\Attendance;
use Carbon\Carbon;
use App\Employee;
use App\Failure;

class RankController extends Controller
{
    public function index()
    {

        $response = collect([]);
        $score = 100;
        $currentDate = null;
        $lastRecordedAt = Attendance::orderBy('recorded_at', 'desc')->first()->recorded_at;
        $employees = Employee::orderBy('name')->get();

        $attendances = Attendance::where('recorded_at', 'like', Carbon::parse($lastRecordedAt)
                ->subMonth()
                ->format('Y-m-%'))
            ->get();

        foreach ($employees as $i => $employee) {
            $response->push(collect([
                'employee_id' => $employee->id,
                'number' => $employee->number,
                'name' => $employee->name,
                'attendances' => 0,
                'failures' => 0,
                'rating' => ($employee->lastRating()->evaluate ?? 0),
                'period' => Carbon::parse($lastRecordedAt)->subMonth()->format('F Y'),
            ]));

            $sumFailure = 0;
            foreach ($employee->failures as $failure) {
                $sumFailure += $failure->score;
            }
            $response[$i]->put('failures', $sumFailure);
        }

        foreach ($attendances as $attendance) {
            $current = $response->where('employee_id', $attendance->employee_id)->first();

            if ($attendance->type !== Attendance::UNKNOWN) {
                if ($attendance->type === Attendance::OVERNIGHT_END) {
                    $score = 0;
                } else {
                    $score = 100;
                }

                if ($attendance->additional_type === Attendance::LATE) {
                    $score -= 50;
                }

                if ($currentDate != $attendance->recorded_at and $score != 0) {
                    $newScore = $current['attendances'] + $score;

                    $current->put('attendances', $newScore);
                    $currentDate = $attendance->recorded_at;
                }

                if ($attendance->additional_type === Attendance::OVERTIME) {
                    $newScore = $current['attendances'] + 50;
                    $current->put('attendances', $newScore);
                }
            }
        }


        return Rank::collection($response);
    }
}
