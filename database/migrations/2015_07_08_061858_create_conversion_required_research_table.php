<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConversionRequiredResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversion_required_research', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('research_id')->unsigned();
            $table->integer('qty')->default(1);

            $table->primary(['resource_id', 'research_id']);
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('conversion_required_research', function (Blueprint $table) {
            $table->dropForeign('conversion_required_research_resource_id_foreign');
            $table->dropForeign('conversion_required_research_research_id_foreign');
        });
        Schema::drop('conversion_required_research');
    }
}
