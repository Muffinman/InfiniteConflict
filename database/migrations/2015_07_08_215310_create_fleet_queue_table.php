<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFleetQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fleet_id')->unsigned();
            $table->string('type');
            $table->integer('qty')->unsigned();
            $table->integer('resource_id')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('planet_id')->unsigned()->nullable();
            $table->integer('turns')->unsigned();
            $table->boolean('started');
            $table->integer('rank')->unsigned();
            $table->boolean('repeat');

            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('planet_id')->references('id')->on('planets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fleet_queue', function (Blueprint $table) {
            $table->dropForeign('fleet_queue_fleet_id_foreign');
            $table->dropForeign('fleet_queue_resource_id_foreign');
            $table->dropForeign('fleet_queue_unit_id_foreign');
            $table->dropForeign('fleet_queue_planet_id_foreign');
        });
        Schema::drop('fleet_queue');
    }
}
