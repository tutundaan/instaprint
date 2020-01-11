<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\FailureStoreRequest;
use App\Http\Requests\FailureLinkRequest;
use App\Http\Controllers\Controller;
use App\Imports\FailureImport;
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

    public function index()
    {
        $failures = Failure::orderBy('number', 'desc')->paginate(100);

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
