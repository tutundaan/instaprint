<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RatingStoreRequest;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Rating;
use Alert;

class RatingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Rating::class, 'rating');
    }

    public function index()
    {
        $employees = Employee::with('ratings')
            ->orderBy('name')
            ->paginate(25);

        return view('auth.rating.index', compact('employees'));
    }

    public function store(RatingStoreRequest $request) 
    {
        $employee = Employee::findOrFail($request->employee);
        $employee->ratings()->create($request->validated());

        Alert::success('Berhasil menyimpan Rating');
        return redirect()->route('auth.rating.index');
    }

    public function show(Rating $rating)
    {
        $employee = Employee::with('orderedRatings')->find($rating->employee->id);

        return view('auth.rating.show', compact('employee'));
    }
}
