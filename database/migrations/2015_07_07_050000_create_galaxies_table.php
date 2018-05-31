<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalaxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galaxies', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('home')->default(0);
            $table->integer('rows')->default(2);
            $table->integer('cols')->default(5);
            $table->integer('type')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('galaxies');
    }
}
