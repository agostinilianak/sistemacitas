<?php

use Illuminate\Database\Seeder;

class MedicinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicinas')->insert([
            'nombre' => 'Acetaminofen',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Adrenalina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Amoxicilina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Ampicilina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Aspirina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Azitromicina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Benzetacil',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Ciprofloxacina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Clindamicina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Cotrimoxazol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Dexametasona',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Diazepam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Estrogeno',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Fluconazol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Hidrocortisona',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Ibuprofeno',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Ketoconazol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Metronidazol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Misoprostol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Oxitocina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Paracetamol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Penicilina',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Progesterona',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Sulfato De Magnesio',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('medicinas')->insert([
            'nombre' => 'Tetanol',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
