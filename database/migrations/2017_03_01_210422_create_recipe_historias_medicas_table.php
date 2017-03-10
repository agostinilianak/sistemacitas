<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeHistoriasMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_historias_medicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_medica_id')->unsigned();
            $table->foreign('historia_medica_id')->references('id')->on('historias_medicas');
            $table->enum('status', ['activo', 'entregado', 'cancelado']);
            $table->text('observaciones', 300);
            $table->integer('farmaceuta_id')->unsigned();
            $table->foreign('farmaceuta_id')->references('id')->on('users');
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
        Schema::dropIfExists('recipe_historias_medicas');
    }
}
