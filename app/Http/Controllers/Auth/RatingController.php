<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RatingStoreRequest;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Rating;
use Alert;
use Auth;

class RatingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Rating::class, 'rating');
    }

    public function index()
    {
        $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
            ->orderBy('name')
            ->paginate(25);

        return view('auth.rating.index', compact('employees'));
    }

    public function store(RatingStoreRequest $request) 
    {
        $employee = Employee::with('ratings')
            ->findOrFail($request->employee);

        $lastRating = $employee->lastSupervisorRating();

        if ($lastRating) {
            $lastRating->update($request->validated());
            Alert::success('Rating lama diperbaharui');
        } else {
            Alert::success('Berhasil menyimpan Rating');
            $employee->ratings()->create($request->validated());
        }

        return redirect()->route('auth.rating.index');
    }

    public function show(Rating $rating)
    {
        $employee = Employee::with('orderedRatings.user')->find($rating->employee->id);

        return view('auth.rating.show', compact('employee'));
    }

}
