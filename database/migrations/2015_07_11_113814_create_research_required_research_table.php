<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchRequiredResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_required_research', function (Blueprint $table) {
            $table->integer('research_id')->unsigned();
            $table->integer('requirement_id')->unsigned();

            $table->primary(['research_id', 'requirement_id']);
            $table->foreign('research_id')->references('id')->on('research')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('requirement_id')->references('id')->on('research')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('research_required_research', function (Blueprint $table) {
            $table->dropForeign('research_required_research_research_id_foreign');
            $table->dropForeign('research_required_research_requirement_id_foreign');
        });
        Schema::drop('research_required_research');
    }
}
