<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_resource', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->integer('cost');
            $table->integer('output');
            $table->integer('stores');
            $table->boolean('refund_on_completion');

            $table->primary(['unit_id', 'resource_id']);
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('unit_resource', function (Blueprint $table) {
            $table->dropForeign('unit_resource_unit_id_foreign');
            $table->dropForeign('unit_resource_resource_id_foreign');
        });
        Schema::drop('unit_resource');
    }
}
