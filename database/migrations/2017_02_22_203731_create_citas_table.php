<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_cita');
            $table->time('hora');
            $table->string('medico');
            $table->string('especialidad_id');
            $table->enum('status', ['concluidas', 'solicitadas', 'canceladas']);
            $table->string('telefono');
            $table->timestamps();
        });
            $table->primary(['medico_id', 'especialidad_id', 'fecha_cita']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
