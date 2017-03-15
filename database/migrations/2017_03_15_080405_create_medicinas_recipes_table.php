
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinasRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinas_recipes', function (Blueprint $table) {

            $table->integer('recipe_id')->unsigned();
            $table->integer('medicina_id')->unsigned();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('medicina_id')->references('id')->on('medicinas');

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
        Schema::dropIfExists('medicinas_recipes');
    }
}