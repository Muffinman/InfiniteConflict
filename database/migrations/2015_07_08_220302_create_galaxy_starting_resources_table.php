<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalaxyStartingResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galaxy_starting_resources', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('home_min_stored')->unsigned()->nullable()->unsigned();
            $table->integer('home_max_stored')->unsigned()->nullable()->unsigned();
            $table->integer('home_min_abundance')->unsigned()->nullable()->unsigned();
            $table->integer('home_max_abundance')->unsigned()->nullable()->unsigned();
            $table->integer('free_min_stored')->unsigned()->nullable()->unsigned();
            $table->integer('free_max_stored')->unsigned()->nullable()->unsigned();
            $table->integer('free_min_abundance')->unsigned()->nullable()->unsigned();
            $table->integer('free_max_abundance')->unsigned()->nullable()->unsigned();
            $table->primary(['resource_id']);
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
        Schema::table('galaxy_starting_resources', function (Blueprint $table) {
            $table->dropForeign('galaxy_starting_resources_resource_id_foreign');
        });
        Schema::drop('galaxy_starting_resources');
    }
}
