<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_resource', function (Blueprint $table) {
            $table->integer('building_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->integer('cost');
            $table->integer('output');
            $table->integer('single_output');
            $table->integer('stores');
            $table->double('interest', 15, 8);
            $table->integer('abundance');
            $table->boolean('refund_on_completion');

            $table->primary(['building_id', 'resource_id']);
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('building_resource', function (Blueprint $table) {
            $table->dropForeign('building_resource_building_id_foreign');
            $table->dropForeign('building_resource_resource_id_foreign');
        });
        Schema::drop('building_resource');
    }
}
