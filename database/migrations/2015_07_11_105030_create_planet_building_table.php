<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_building', function (Blueprint $table) {
            $table->integer('planet_id')->unsigned();
            $table->integer('building_id')->unsigned();
            $table->integer('qty')->unsigned();

            $table->primary(['planet_id', 'building_id']);
            $table->foreign('planet_id')->references('id')->on('planets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('planet_building', function (Blueprint $table) {
            $table->dropForeign('planet_building_planet_id_foreign');
            $table->dropForeign('planet_building_building_id_foreign');
        });
        Schema::drop('planet_building');
    }
}
