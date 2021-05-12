<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulerResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruler_resource', function (Blueprint $table) {
            $table->integer('ruler_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->bigInteger('stored')->unsigned();

            $table->primary(['ruler_id', 'resource_id']);
            $table->foreign('ruler_id')->references('id')->on('rulers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('ruler_resource', function (Blueprint $table) {
            $table->dropForeign('ruler_research_ruler_id_foreign');
            $table->dropForeign('ruler_research_resource_id_foreign');
        });
        Schema::drop('ruler_resource');
    }
}
