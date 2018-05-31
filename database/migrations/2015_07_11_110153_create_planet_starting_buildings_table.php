<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanetStartingBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_starting_buildings', function (Blueprint $table) {
            $table->integer('building_id')->unsigned();
            $table->integer('qty')->unsigned();

            $table->primary('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planet_starting_buildings', function (Blueprint $table) {
            $table->dropForeign('planet_starting_buildings_building_id_foreign');
        });
        Schema::drop('planet_starting_buildings');
    }
}
