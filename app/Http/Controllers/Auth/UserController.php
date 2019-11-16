<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\Auth\UserUpdateRequest;

class UserController extends Controller
{
	public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

	public function index()
	{
		$users = User::orderBy('name')
			->with('role')
			->paginate(15);
		$roles = Role::get(['name', 'slug']);

		return view('auth.user.index', compact('users', 'roles'));
	}

	public function store(UserStoreRequest $request)
	{
		$role = ($request->role ? Role::whereSlug($request->role)->first() : Role::whereSlug(Role::ADMIN)->first());
		$role->users()->create($request->validated());

		return redirect()->back();
	}

	public function update(User $user, UserUpdateRequest $request)
	{
		$user->update($request->validated());
		$user->role_id = ($request->role ? Role::whereSlug($request->role)->first()->id : Role::whereSlug(Role::ADMIN)->first()->id);
		$user->save();

		return redirect()->back();
	}

	public function destroy(User $user)
	{
		$user->delete();

		return redirect()->back();
	}

	public function block(User $user)
	{
		$this->authorize('block', [Auth::user(), $user]);
		$user->block();

		return redirect()->back();
	}

	public function unblock(User $user)
	{
		$this->authorize('unblock', [Auth::user(), $user]);
		$user->unblock();
		
		return redirect()->back();
	}
}
