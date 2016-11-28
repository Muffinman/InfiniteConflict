<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('ruler_id')->unsigned()->nullable();
            $table->integer('planet_id')->unsigned()->nullable();
            $table->integer('destination_id')->unsigned()->nullable();
            $table->boolean('moving');
            $table->integer('turns')->nullable();

            $table->foreign('ruler_id')->references('id')->on('rulers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('planet_id')->references('id')->on('planets')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('destination_id')->references('id')->on('planets')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fleets', function (Blueprint $table) {
            $table->dropForeign('fleets_ruler_id_foreign');
            $table->dropForeign('fleets_planet_id_foreign');
            $table->dropForeign('fleets_destination_id_foreign');
        });
        Schema::drop('fleets');
    }
}
