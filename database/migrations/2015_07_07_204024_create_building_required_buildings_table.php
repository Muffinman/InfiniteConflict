<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingRequiredBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_required_buildings', function (Blueprint $table) {
            $table->integer('building_id')->unsigned();
            $table->integer('requirement_id')->unsigned();
            $table->integer('qty')->default(1);

            $table->primary(['building_id', 'requirement_id']);
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('building_required_buildings', function (Blueprint $table) {
            $table->dropForeign('building_required_buildings_building_id_foreign');
            $table->dropForeign('building_required_buildings_requirement_id_foreign');
        });
        Schema::drop('building_required_buildings');
    }
}
