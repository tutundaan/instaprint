<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class PageController extends Controller
{
	public function home()
	{
        if (Auth::user()->isAdmin()) {
            return redirect()->route('auth.user.index');
        }

        return redirect()->route('auth.dashboard.index');
	}
}
