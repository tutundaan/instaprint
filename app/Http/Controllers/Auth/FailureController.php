<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\FailureStoreRequest;
use App\Http\Requests\FailureLinkRequest;
use App\Http\Controllers\Controller;
use App\Imports\FailureImport;
use Illuminate\Http\Request;
use App\Failure;
use Excel;
use Alert;
use Auth;

class FailureController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Failure::class, 'failure');
    }

    public function index(Request $request)
    {
        $failures = Failure::query();

        if ($request->has('holder')) {
            is_null($request->holder) ?: $failures = $failures->where('holder', $request->holder);
        }

        if ($request->has('job')) {
            is_null($request->job) ?: $failures = $failures->where('number', "{$request->job}");
        }

        if ($request->has('employee')) {
            is_null($request->employee) ?: $failures = $failures->where('employee_id', "{$request->employee}");
        }

        if ($request->has('notes')) {
            is_null($request->notes) ?: $failures = $failures->where('note', 'like', "%{$request->notes}%");
        }

        $failures = $failures->orderBy('number')->paginate(100);

        return view('auth.failure.index', compact('failures'));
    }

    public function store(FailureStoreRequest $request)
    {
        Excel::import(new FailureImport, $request->file);
        Alert::toast('Bershail Import SPK Kesalahan', 'success');
        return redirect()->route('auth.failure.index');
    }

    public function link(Failure $failure, FailureLinkRequest $request)
    {
        $this->authorize('link', $failure);

        $failures = Failure::whereNull('employee_id')
            ->where('holder', $failure->holder)
            ->update([
                'employee_id' => $request->employee_id,
            ]);

        Alert::toast('Bershail Menautkan SPK Kesalahan', 'success');
        return redirect()->back();
    }

    public function relink(Failure $failure, FailureLinkRequest $request)
    {
        $this->authorize('relink', $failure);

        $failures = Failure::where('employee_id', $failure->employee_id)
            ->where('holder', $failure->holder)
            ->update([
                'employee_id' => $request->employee_id,
            ]);

        Alert::toast('Bershail mengubah Tautan SPK Kesalahan', 'success');
        return redirect()->back();
    }
}
