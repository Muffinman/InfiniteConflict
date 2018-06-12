<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanetUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_unit', function (Blueprint $table) {
            $table->integer('planet_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('qty')->unsigned();

            $table->primary(['planet_id', 'unit_id']);
            $table->foreign('planet_id')->references('id')->on('planets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planet_unit', function (Blueprint $table) {
            $table->dropForeign('planet_unit_planet_id_foreign');
            $table->dropForeign('planet_unit_unit_id_foreign');
        });
        Schema::drop('planet_unit');
    }
}
