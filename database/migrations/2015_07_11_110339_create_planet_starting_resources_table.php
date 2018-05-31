<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanetStartingResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_starting_resources', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('stored')->unsigned();
            $table->integer('abundance');

            $table->primary('resource_id');
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planet_starting_resources', function (Blueprint $table) {
            $table->dropForeign('planet_starting_resources_resource_id_foreign');
        });
        Schema::drop('planet_starting_resources');
    }
}
