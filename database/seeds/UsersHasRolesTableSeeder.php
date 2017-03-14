<?php

use Illuminate\Database\Seeder;

class UsersHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_has_roles')->insert([
            'role_id'=>1,
            'user_id'=>1,
        ]);
        DB::table('user_has_roles')->insert([
            'role_id'=>5,
            'user_id'=>2,
        ]);
        DB::table('user_has_roles')->insert([
            'role_id'=>5,
            'user_id'=>3,
        ]);
    }
}
