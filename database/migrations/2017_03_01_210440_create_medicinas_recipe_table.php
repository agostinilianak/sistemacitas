<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinasRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinas_recipe', function (Blueprint $table) {

            $table->integer('recipe_id')->unsigned();
            $table->integer('medicina_id')->unsigned();

            $table->foreign('recipe_id')->references('id')->on('recipe');
            $table->foreign('medicina_id')->references('id')->on('medicina');

            $table->primary(['recipe_id', 'medicina_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicinas_recipe', function(Blueprint $table){
            $table->dropForeign('medicinas_recipe_id_foreign');
            $table->dropColumn('medicina_id');
            $table->dropColumn('recipe_id');
        });
    }
}
