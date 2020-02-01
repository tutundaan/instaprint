<?php

namespace App\Http\Controllers\Auth;

use Auth;
Use Hash;
Use Alert;
use App\User;
use App\Role;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkUserRequest;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\Auth\UserUpdateRequest;
use App\Http\Requests\Auth\ChangeUpdateRequest;
use App\Http\Requests\Auth\PasswordUpdateRequest;

class UserController extends Controller
{
	public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

	public function index(Request $request)
	{
        if ($request->has('nama')) {
            $users = User::orderBy('name')
                ->with('role')
                ->where('name', 'like', '%' . $request->nama . '%')
                ->paginate(15);

        } else {
            $users = User::orderBy('name')
                ->with('role')
                ->paginate(15);
        }

		$roles = Role::get(['name', 'slug']);

		return view('auth.user.index', compact('users', 'roles'));
	}

	public function store(UserStoreRequest $request)
	{
		$role = ($request->role ? Role::whereSlug($request->role)->first() : Role::whereSlug(Role::ADMIN)->first());
		$role->users()->create($request->validated());

		Alert::toast('Berhasil menambah User', 'success');

		return redirect()->back();
	}

	public function update(User $user, UserUpdateRequest $request)
	{
		$user->update($request->validated());
		$user->role_id = ($request->role ? Role::whereSlug($request->role)->first()->id : Role::whereSlug(Role::ADMIN)->first()->id);
		$user->save();

		Alert::toast('Berhasil mengubah User', 'success');

		return redirect()->back();
	}

	public function destroy(User $user)
	{
		$user->delete();

		Alert::toast('Berhasil menghapus User', 'success');

		return redirect()->back();
	}

	public function block(User $user)
	{
		$this->authorize('block', [Auth::user(), $user]);
		$user->block();

		Alert::toast('Berhasil Block User', 'success');

		return redirect()->back();
	}

	public function unblock(User $user)
	{
		$this->authorize('unblock', [Auth::user(), $user]);
		$user->unblock();
		
		Alert::toast('Berhasil Unlock User', 'success');

		return redirect()->back();
	}

	public function show(User $user)
	{
		return view('auth.user.show', compact('user'));
	}

	public function changePassword(User $user, PasswordUpdateRequest $request)
	{
		$this->authorize('changePassword', [Auth::user(), $user]);

		if (Hash::check($request->validated()['last_password'], Auth::user()->password)) {
			return $this->updatePassword($request->validated());
		}

		Alert::toast('Password lama tidak sesuai', 'error');
		return redirect()->back();
	}

	private function updatePassword(array $request)
	{

		$user = Auth::user();
		$user->password = bcrypt($request['password']);
		$user->save();

		Alert::toast('Berhasil mengubah password', 'success');
		return redirect()->back();
	}

	public function change(User $user, ChangeUpdateRequest $request)
	{
		$this->authorize('change', [Auth::user(), $user]);

		$user = Auth::user();
		$user->update($request->validated());

		Alert::toast('Berhasil mengubah data', 'success');
		return redirect()->route('auth.user.show', $user);
    }

    public function link(LinkUserRequest $request)
    {
        $employee = Employee::findOrFail($request->employee_id);

        $this->authorize('link', [Auth::user(), $employee]);

		$role = ($request->role ? Role::whereSlug($request->role)->first() : Role::whereSlug(Role::EMPLOYEE)->first());
        $user = $role->users()->create($request->validated());

        $employee->user()->associate($user);
        $employee->save();

        $user->linked = true;
        $user->save();

		Alert::toast('Berhasil menautkan Akun', 'success');
		return redirect()->back();
    }
}
