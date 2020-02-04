<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rank;
use App\Employee;
use App\Attendance;

class RankController extends Controller
{
    public function index()
    {

        $response = collect([]);
        $score = 100;
        $currentDate = null;

        $employees = Employee::with([
                'attendances',
                'failures',
            ])
            ->orderBy('name')
            ->whereHas('attendances', function ($q) {
                $q->orderBy('recorded_at');
                $q->orderBy('recorded_time');
            })
            ->get();

        foreach ($employees as $i => $employee) {
            $response->push(collect([
                'number' => $employee->number,
                'name' => $employee->name,
                'attendances' => collect([]),
                'failure' => collect([]),
            ]));

            dd($employee);

            foreach ($employee->attendances as $attendance) {
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
                        $response[$i]->get('attendances')->put($attendance->recorded_at, $score);
                        $currentDate = $attendance->recorded_at;
                    }

                    if ($attendance->additional_type === Attendance::OVERTIME) {
                        $newScore = $response[$i]->get('attendances')->get($attendance->recorded_at) + 50;

                        $response[$i]->get('attendances')->put($attendance->recorded_at, $newScore);
                    }

                }

            }
        }

        return response()->json($response);
    }
}
