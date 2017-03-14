<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriasMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiasmedicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_id')->unsigned();
            $table->foreign('cita_id')->references('id')->on('citas');
            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('users');
            $table->integer('especialidad_id')->unsigned();
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('users');
            $table->text('motivoconsulta');
            $table->text('a_familiares', 300);
            $table->text('a_personales', 300);
            $table->text('examenfisico', 300);
            $table->text('indicacionesHM', 500);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiasmedicas');
    }
}
