<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AccountLinkerStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\User;
use App\Role;
use Alert;
use Gate;

class LinkAccountController extends Controller
{
    public function index(Request $request)
    {
        if(Gate::allows('link-account')) {

            if( $request->has('id') ) {

                $employees = Employee::with('user')
                    ->orderBy('number')
                    ->where('number', 'like', '%' . $request->id .  '%')
                    ->paginate(20);

            } else {

                $employees = Employee::with('user')
                    ->orderBy('number')->paginate(20);

            }

            $users = Role::where('slug', Role::EMPLOYEE)->with('users')->first()->users()->where('linked', false)->get();
            $roles = Role::get(['name', 'slug']);

            return view('auth.link-account.index', compact('employees', 'users', 'roles'));
        }

        return abort(403);

    }

    public function store(AccountLinkerStoreRequest $request)
    {
        $employee = Employee::find($request->employee_id);

        $this->authorize('update', $employee);

        if(Gate::allows('link-account')) {
            $user = User::find($request->user_id);

            $employee->user()->associate($user);
            $employee->save();
            $user->linked = true;
            $user->save();

            Alert::toast('Berhasil menyambungkan Akun', 'success');

            return redirect()->back();
        }

        return abort(403);
        
    }
}
