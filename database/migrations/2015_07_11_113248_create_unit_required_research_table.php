<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitRequiredResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_required_research', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned();
            $table->integer('research_id')->unsigned();

            $table->primary(['unit_id', 'research_id']);
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('unit_required_research', function (Blueprint $table) {
            $table->dropForeign('unit_required_research_unit_id_foreign');
            $table->dropForeign('unit_required_research_research_id_foreign');
        });
        Schema::drop('unit_required_research');
    }
}
