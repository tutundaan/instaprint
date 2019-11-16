<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function home()
	{
		return view('auth.page.home');
	}
}
