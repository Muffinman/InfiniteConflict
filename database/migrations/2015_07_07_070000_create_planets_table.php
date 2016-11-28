<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32)->nullable();
            $table->integer('ruler_id')->unsigned()->nullable();
            $table->integer('galaxy_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->integer('col');
            $table->integer('row');            
            $table->boolean('home')->default(0);
            $table->integer('type');
            $table->unique(['system_id', 'col', 'row']);
            $table->foreign('ruler_id')->references('id')->on('rulers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('galaxy_id')->references('id')->on('galaxies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planets', function (Blueprint $table) {
            $table->dropForeign('planets_ruler_id_foreign');
            $table->dropForeign('planets_system_id_foreign');
            $table->dropForeign('planets_galaxy_id_foreign');
        });
        Schema::drop('planets');
    }
}
