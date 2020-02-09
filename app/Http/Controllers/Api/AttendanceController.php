<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttendanceApiStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeRange;
use App\Http\Resources\Rank;
use Illuminate\Http\Request;
use Carbon\CarbonInterval;
use App\Attendance;
use Carbon\Carbon;
use App\Employee;

class AttendanceController extends Controller
{
    public function store($employee, AttendanceApiStoreRequest $request)
    {
        $employees = Employee::with([
            'ratings',
            'ratings.user',
            'failures',
            'attendances',
            'user',
            'user.role',
        ])->findOrFail($employee);

        return new EmployeeRange($employees, $request->start, $request->end);
    }

    public function index(Request $request)
    {
        if ($request->filter) {
            $now = Carbon::parse($request->filter);
        } else {
            $now = now();
        }

        $currentDate = null;
        $employees = Employee::orderBy('name')->get();
        $attendances = Attendance::where('recorded_at', 'like', $now->format('Y-m-') . '%')->get();

        $firstRange = Carbon::parse(Attendance::orderBy('recorded_at', 'asc')->first()->recorded_at);
        $lastRange = Carbon::parse(Attendance::orderBy('recorded_at', 'desc')->first()->recorded_at);
        $interval = CarbonInterval::make('1month');
        $ranges = collect([]);

        foreach ($firstRange->range($lastRange, $interval) as $carbon) {
            $ranges->push($carbon->format('F Y'));
        }

        $response = collect([]);
        foreach ($employees as $i => $employee) {
            $response->push(collect([
                'employee_id' => $employee->id,
                'number' => $employee->number,
                'name' => $employee->name,
                'attendances' => 0,
                'failures' => 0,
                'rating' => 0,
                'period' => $now->monthName,
                'ranges' => $ranges->all(),
                'score' => 0,
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

        return Rank::collection($response);
    }
}
