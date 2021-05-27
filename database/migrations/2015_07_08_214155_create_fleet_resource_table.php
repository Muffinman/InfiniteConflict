<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFleetResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_resource', function (Blueprint $table) {
            $table->integer('fleet_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->bigInteger('stored');

            $table->primary(['fleet_id', 'resource_id']);
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('fleet_resource', function (Blueprint $table) {
            $table->dropForeign('fleet_resource_fleet_id_foreign');
            $table->dropForeign('fleet_resource_resource_id_foreign');
        });
        Schema::drop('fleet_resource');
    }
}
