<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanetColoResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_colo_resources', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('qty')->unsigned();
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
        Schema::table('planet_colo_resources', function (Blueprint $table) {
            $table->dropForeign('planet_colo_resources_resource_id_foreign');
        });
        Schema::drop('planet_colo_resources');
    }
}
