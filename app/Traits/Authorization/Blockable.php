<?php 

namespace App\Traits\Authorization;

use Auth;
use App\Role;
use App\User;
use Exception;

trait Blockable {

	private function blockableCheck()
	{
		if (!($this instanceof \App\Contracts\AuthorizationContract)) {
			throw new Exception("You must implements AuthorizationContract");
		}
	}

	public function block()
	{
		$this->is_blocked = true;
		return $this->save();
	}

	public function unblock()
	{
		$this->is_blocked = false;
		return $this->save();
	}

	public function ableToChangeUserStatus(User $user)
	{
		$this->blockableCheck();

		return $user->authorize()->slug === Role::ADMIN;
	}

	public function currentlyLogin()
	{
		return $this == Auth::user();
	}
}