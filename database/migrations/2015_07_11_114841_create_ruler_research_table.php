<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulerResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruler_research', function (Blueprint $table) {
            $table->integer('ruler_id')->unsigned();
            $table->integer('research_id')->unsigned();

            $table->primary(['ruler_id', 'research_id']);
            $table->foreign('ruler_id')->references('id')->on('rulers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('ruler_research', function (Blueprint $table) {
            $table->dropForeign('ruler_research_ruler_id_foreign');
            $table->dropForeign('ruler_research_research_id_foreign');
        });
        Schema::drop('ruler_research');
    }
}
