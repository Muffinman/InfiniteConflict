<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFleetUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_units', function (Blueprint $table) {
            $table->integer('fleet_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('qty');

            $table->primary(['fleet_id', 'unit_id']);
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('fleet_units');
    }
}
