<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanetResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_resource', function (Blueprint $table) {
            $table->integer('planet_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->bigInteger('stored')->unsigned()->default(0);
            $table->bigInteger('busy')->unsigned()->default(0);
            $table->smallInteger('abundance')->unsigned()->default(0);
            $table->integer('storage_cache')->unsigned()->default(0);
            $table->integer('output_cache')->default(0);
            $table->smallInteger('abundance_cache')->unsigned()->default(0);


            $table->primary(['planet_id', 'resource_id']);
            $table->foreign('planet_id')->references('id')->on('planets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('planet_resource', function (Blueprint $table) {
            $table->dropForeign('planet_resource_planet_id_foreign');
            $table->dropForeign('planet_resource_resource_id_foreign');
        });
        Schema::drop('planet_resource');
    }
}
