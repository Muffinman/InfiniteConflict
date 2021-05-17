<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitRequiredBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_required_buildings', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned();
            $table->integer('requirement_id')->unsigned();
            $table->integer('qty')->default(1);

            $table->primary(['unit_id', 'requirement_id']);
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('requirement_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_required_buildings', function (Blueprint $table) {
            $table->dropForeign('unit_required_buildings_unit_id_foreign');
            $table->dropForeign('unit_required_buildings_requirement_id_foreign');
        });
        Schema::drop('unit_required_buildings');
    }
}
