<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResearchResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_resource', function (Blueprint $table) {
            $table->integer('research_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->integer('cost');

            $table->primary(['research_id', 'resource_id']);
            $table->foreign('research_id')->references('id')->on('research')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('research_resource', function (Blueprint $table) {
            $table->dropForeign('research_resource_research_id_foreign');
            $table->dropForeign('research_resource_resource_id_foreign');
        });
        Schema::drop('research_resource');
    }
}
