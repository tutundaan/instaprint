<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FailureApiStoreRequest;
use App\Http\Resources\EmployeeRange;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rank;
use Illuminate\Http\Request;
use Carbon\CarbonInterval;
use App\Attendance;
use Carbon\Carbon;
use App\Employee;
use App\Failure;

class FailureController extends Controller
{
    public function store($employee, FailureApiStoreRequest $request)
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

        $failures = Failure::whereNotNull('employee_id')
                ->where('created_at', 'like', $now->format('Y-m-') . '%')
                ->get();

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
