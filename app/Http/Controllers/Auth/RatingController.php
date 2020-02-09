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
        $date = ($request->filter ? Carbon::parse($request->filter) : now());

        if (Auth::user()->isManager()) {
            if ($request->filter) {
                $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                    ->orderBy('name')
                    ->whereHas('recomendations', function () {
                    })
                    ->whereHas('ratings', function ($query) use ($date) {
                        $query->where('created_at', 'like', $date->format('Y-m-') . '%');
                    })
                    ->paginate(25);
            } else {
                $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                    ->orderBy('name')
                    ->whereHas('recomendations', function () {
                    })
                    ->paginate(25);
            }
        } else {
            if ($request->filter) {
                $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                    ->orderBy('name')
                    ->whereHas('ratings', function ($query) use ($date) {
                        $query->where('created_at', 'like', $date->format('Y-m-') . '%');
                    })
                    ->paginate(25);
            } else {
                $employees = Employee::with(['ratings.user', 'recomendations.user', 'recomendations.approvedBy'])
                    ->orderBy('name')
                    ->paginate(25);
            }
        }

        $ranges = collect([]);

        foreach (Rating::pluck('created_at') as $carbon) {
            if (!$ranges->contains($carbon->format('F Y'))) {
                $ranges->push($carbon->format('F Y'));
            }
        }

        $ranges = $ranges->all();

        return view('auth.rating.index', compact('employees', 'ranges'));
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
