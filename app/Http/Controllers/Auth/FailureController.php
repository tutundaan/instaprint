<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\FailureStoreRequest;
use App\Http\Controllers\Controller;
use App\Imports\FailureImport;
use App\Failure;
use Excel;

class FailureController extends Controller
{
    public function index()
    {
        $failures = Failure::orderBy('created_at', 'desc')->paginate(100);

        return view('auth.failure.index', compact('failures'));
    }

    public function store(FailureStoreRequest $request)
    {
        Excel::import(new FailureImport, $request->file);
    }
}
