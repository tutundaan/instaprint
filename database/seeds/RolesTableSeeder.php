<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->delete();

    	$roles = [
    		['name' => 'Admin', 'slug' => Role::ADMIN],
    		['name' => 'Supervisor', 'slug' => Role::SUPERVISOR],
    		['name' => 'Manager', 'slug' => Role::MANAGER],
    	];

    	foreach ($roles as $role) {
    		Role::create($role);
    	}
    }
}
