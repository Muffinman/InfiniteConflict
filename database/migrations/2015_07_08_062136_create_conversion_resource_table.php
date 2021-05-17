<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConversionResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversion_resource', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('cost_resource')->unsigned();
            $table->integer('cost');
            $table->boolean('refund_on_completion');

            $table->primary(['resource_id', 'cost_resource']);
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cost_resource')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversion_resource', function (Blueprint $table) {
            $table->dropForeign('conversion_resource_resource_id_foreign');
            $table->dropForeign('conversion_resource_cost_resource_foreign');
        });
        Schema::drop('conversion_resource');
    }
}
