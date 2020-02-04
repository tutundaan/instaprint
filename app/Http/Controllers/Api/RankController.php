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
                'attendances' => 0,
                'failures' => 0,
                'rating' => ($employee->lastRating()->evaluate ?? 0),
            ]));

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
                        $newScore = $response[$i]->get('attendances') + $score;

                        $response[$i]->put('attendances', $newScore);
                        $currentDate = $attendance->recorded_at;
                    }

                    if ($attendance->additional_type === Attendance::OVERTIME) {
                        $newScore = $response[$i]->get('attendances') + 50;
                        $response[$i]->put('attendances', $newScore);
                    }
                }
            }

            $sumFailure = 0;
            foreach ($employee->failures as $failure) {
                $sumFailure += $failure->score;
            }
            $response[$i]->put('failures', $sumFailure);
        }

        return Rank::collection($response);
    }
}
