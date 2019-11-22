<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Excel;
use App\User;
use App\Attendance;
use App\Http\Controllers\Controller;
use App\Imports\MonthlyAttendanceImport;
use App\Http\Requests\Auth\MonthlyAttendanceStoreRequest;

class MonthlyAttendanceController extends Controller
{
	public function __construct()
    {
        $this->authorizeResource(Attendance::class, 'attendance');
    }

	public function create()
	{
		return view('auth.monthly-attendance.create');
	}

	public function store(MonthlyAttendanceStoreRequest $request)
	{
		$file = $request->validated()['attendance'];

		Excel::import(new MonthlyAttendanceImport, $file);
	}
}
