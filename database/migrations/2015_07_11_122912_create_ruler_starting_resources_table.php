<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulerStartingResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruler_starting_resources', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('stored')->unsigned();

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
        Schema::table('ruler_starting_resources', function (Blueprint $table) {
            $table->dropForeign('ruler_starting_resources_resource_id_foreign');
        });
        Schema::drop('ruler_starting_resources');
    }
}
