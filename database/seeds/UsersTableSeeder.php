<?php

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
        DB::table('users')->insert([
            'nombre' => 'Administrador',
            'apellido'=>'Sistema Citas',
            'cedula'=>'1111111',
            'fecha_nacimiento'=>'2017-02-21',
            'sexo'=>'F',
            'celular'=>'04241669545',
            'direccion'=>'La California',
            'email' => 'admin@sistemacitas.com',
            'password' => bcrypt('123123'),


            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
