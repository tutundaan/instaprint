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
    		['name' => 'Default Admin', 'phone' => '088888888881', 'password' => 'secret'],
    		['name' => 'Default Supervisor', 'phone' => '088888888882', 'password' => 'secret'],
    		['name' => 'Default Manager', 'phone' => '088888888883', 'password' => 'secret'],
    		['name' => 'Default Karyawan', 'phone' => '088888888884', 'password' => 'secret'],
    	];

    	if (!Role::first()) {
    		$this->call(RolesTableSeeder::class);
    	}

    	(Role::whereSlug(Role::ADMIN)->first())->users()->create($users[0]);
    	(Role::whereSlug(Role::SUPERVISOR)->first())->users()->create($users[1]);
    	(Role::whereSlug(Role::MANAGER)->first())->users()->create($users[2]);
    	(Role::whereSlug(Role::EMPLOYEE)->first())->users()->create($users[3]);
    }
}
