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
            'apellido' => 'Sistema Citas',
            'cedula' => '1111111',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'admin@sistemacitas.com',
            'password' => bcrypt('123123'),


            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Paciente',
            'apellido' => 'Agostini',
            'cedula' => '1111112',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak2@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Paciente',
            'apellido' => 'Rodriguez',
            'cedula' => '1111113',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak3@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Medico',
            'apellido' => 'Romero',
            'cedula' => '1111114',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak4@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Medico',
            'apellido' => 'Bello',
            'cedula' => '1111115',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak5@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Secretaria',
            'apellido' => 'Gomez',
            'cedula' => '1111116',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak6@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nombre' => 'Farmaceuta',
            'apellido' => 'Jimenez',
            'cedula' => '1111117',
            'fecha_nacimiento' => '2017-02-21',
            'sexo' => 'F',
            'celular' => '04241669545',
            'direccion' => 'La California',
            'email' => 'agostinilianak7@gmail.com',
            'password' => bcrypt('123123'),

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
