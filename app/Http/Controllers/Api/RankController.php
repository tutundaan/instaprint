<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rank;
use Illuminate\Http\Request;
use Carbon\CarbonInterval;
use App\Attendance;
use Carbon\Carbon;
use App\Employee;
use App\Failure;

class RankController extends Controller
{
    public function index(Request $request)
    {
        $response = collect([]);
        $score = 100;
        $currentDate = null;
        $lastRecordedAt = ($request->filter ?
            Carbon::parse($request->filter)->endOfMonth()->toDateString() :
            Attendance::orderBy('recorded_at', 'desc')->first()->recorded_at);

        $firstRange = Carbon::parse(Attendance::orderBy('recorded_at', 'asc')->first()->recorded_at);
        $lastRange = Carbon::parse(Attendance::orderBy('recorded_at', 'desc')->first()->recorded_at);
        $interval = CarbonInterval::make('1month');
        $ranges = collect([]);

        foreach ($firstRange->range($lastRange, $interval) as $carbon) {
            $ranges->push($carbon->format('F Y'));
        }

        $firstCarbon = Carbon::parse($lastRecordedAt)->startOfMonth();
        $lastCarbon = Carbon::parse($lastRecordedAt)->endOfMonth();

        $employees = Employee::orderBy('name')->get();

        $attendances = Attendance::where('recorded_at', 'like', Carbon::parse($lastRecordedAt)
                ->format('Y-m-%'))
                ->get();

        $failures = Failure::whereNotNull('employee_id')
                ->where('created_at', 'like', Carbon::parse($lastRecordedAt)
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
                'period' => (
                    $request->filter ? Carbon::parse($request->filter)->format('F Y') :
                    Carbon::parse($lastRecordedAt)->format('F Y')),
                'ranges' => $ranges->all(),
            ]));
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

        $sumFailure = 0;
        foreach ($failures as $failure) {
            $current = $response->where('employee_id', $failure->employee_id)->first();
            $sumFailure += $failure->score;
            $current->put('failures', $current->get('failures') + $sumFailure);
            $sumFailure = 0;
        }

        return Rank::collection($response);
    }
}
