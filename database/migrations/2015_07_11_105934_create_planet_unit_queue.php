<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetUnitQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_unit_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('planet_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('qty')->unsigned();
            $table->integer('turns')->unsigned();
            $table->boolean('started');
            $table->integer('rank')->unsigned();

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
        Schema::table('planet_unit_queue', function (Blueprint $table) {
            $table->dropForeign('planet_unit_queue_planet_id_foreign');
            $table->dropForeign('planet_unit_queue_unit_id_foreign');
        });
        Schema::drop('planet_unit_queue');
    }
}
