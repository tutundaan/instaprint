<?php 

namespace App\Traits\Authorization;

use App\Role;
use Exception;

trait Authorizeable {

	private function interfaceCheck()
	{
		if (!($this instanceof \App\Contracts\AuthorizationContract)) {
			throw new Exception("You must implements AuthorizationContract");
		}
	}

	public function hasRole(string $slug)
	{
		$this->interfaceCheck();
		return $this->authorize()->slug === $slug;
	}

	public function isAdmin()
	{
		$this->interfaceCheck();
		return $this->authorize()->slug === Role::ADMIN;
	}

	public function isSupervisor()
	{
		$this->interfaceCheck();
		return $this->authorize()->slug === Role::SUPERVISOR;
	}

	public function isManager()
	{
		$this->interfaceCheck();
		return $this->authorize()->slug === Role::MANAGER;
	}
}