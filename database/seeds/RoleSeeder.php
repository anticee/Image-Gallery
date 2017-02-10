<?php

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '', // optional
            'level' => 2, // optional, set to 1 by default
        ]);

        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => '', // optional
            'level' => 1, // optional, set to 1 by default
        ]);

        /* Attach admin role to user id 1*/
        $user = User::find(1);
        $user->attachRole($adminRole);
    }
}
