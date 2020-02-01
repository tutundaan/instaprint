<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isSupervisor() or Auth::user()->isManager()) {
            return view('auth.dashboard.index');
        }

        return abort(403);
    }
}
