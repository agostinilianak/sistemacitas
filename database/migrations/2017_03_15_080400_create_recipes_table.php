<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historiamedica_id')->unsigned();
            $table->foreign('historiamedica_id')->references('id')->on('historiasmedicas');
            $table->enum('status', ['activo', 'entregado', 'cancelado']);
            $table->text('observaciones', 300)->nullable();
            $table->integer('farmaceuta_id')->unsigned()->nullable();
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
        Schema::dropIfExists('recipes');
    }
}

