<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RatingStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonInterval;
use Carbon\Carbon;
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

    public function index(Request $request)
    {
        if (Auth::user()->isManager()) {
            $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                ->orderBy('name')
                ->whereHas('recomendations', function () {
                })
                ->paginate(25);
        } else {
            $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                ->orderBy('name')
                ->paginate(25);
        }


        $filteredRating = null;

        if ($request->filter) {
            $carbon = Carbon::parse($request->filter);

            $filteredRating = Rating::where('created_at', 'like', $carbon->format('Y-m-') . '%')->get();
        }

        $ranges = [];

        if (Rating::orderBy('created_at', 'desc')->first()) {
            $interval = CarbonInterval::make('1month');
            $olderCarbonRating = Rating::orderBy('created_at', 'desc')->first()->created_at;
            $newerCarbonRating = Rating::orderBy('created_at', 'asc')->first()->created_at;
            $ranges = $newerCarbonRating->range($olderCarbonRating, $interval);
        }

        return view('auth.rating.index', compact('employees', 'ranges', 'filteredRating'));
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
