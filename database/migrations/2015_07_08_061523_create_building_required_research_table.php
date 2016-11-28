<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingRequiredResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_required_research', function (Blueprint $table) {
            $table->integer('building_id')->unsigned();
            $table->integer('research_id')->unsigned();

            $table->primary(['building_id', 'research_id']);
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('research_id')->references('id')->on('research')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('building_required_research', function (Blueprint $table) {
            $table->dropForeign('building_required_research_building_id_foreign');
            $table->dropForeign('building_required_research_research_id_foreign');
        });
        Schema::drop('building_required_research');
    }
}
