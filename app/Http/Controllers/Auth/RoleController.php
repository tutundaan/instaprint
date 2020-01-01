<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index()
    {
        $roles = Role::with('users', 'blockedUsers')->orderBy('name')->get();

        return view('auth.role.index', compact('roles'));
    }
}
