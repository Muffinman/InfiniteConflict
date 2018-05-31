<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_taxes', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('output_resource')->unsigned();
            $table->double('rate', 15, 8);

            $table->primary(['resource_id', 'output_resource']);
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('output_resource')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resource_taxes', function (Blueprint $table) {
            $table->dropForeign('resource_taxes_resource_id_foreign');
            $table->dropForeign('resource_taxes_output_resource_foreign');
        });
        Schema::drop('resource_taxes');
    }
}
