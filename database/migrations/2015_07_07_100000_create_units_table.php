<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('drive')->nullable();
            $table->integer('turns');
            $table->integer('max_per_ruler')->nullable();
            $table->integer('max_per_fleet')->nullable();
            $table->integer('max_per_planet')->nullable();
            $table->boolean('can_invade');
            $table->boolean('can_colonise');
            $table->integer('hp');
            $table->integer('ap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
    }
}
