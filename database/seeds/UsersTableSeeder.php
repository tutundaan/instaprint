<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();

    	$users = [
    		['name' => 'Default Admin', 'email' => 'admin@example.com', 'password' => 'secret'],
    		['name' => 'Default Supervisor', 'email' => 'supervisor@example.com', 'password' => 'secret'],
    		['name' => 'Default Manager', 'email' => 'manager@example.com', 'password' => 'secret'],
    	];

    	if (!Role::first()) {
    		$this->call(RolesTableSeeder::class);
    	}

    	(Role::whereSlug(Role::ADMIN)->first())->users()->create($users[0]);
    	(Role::whereSlug(Role::SUPERVISOR)->first())->users()->create($users[1]);
    	(Role::whereSlug(Role::MANAGER)->first())->users()->create($users[2]);
    }
}
