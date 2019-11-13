<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	public const ADMIN = 'admin';
	public const SUPERVISOR = 'supervisor';
	public const MANAGER = 'manager';

	protected $fillable = [
		'name', 'slug'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
