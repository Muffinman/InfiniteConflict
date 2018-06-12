<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('hp')->default(0);
            $table->integer('ap')->default(0);
            $table->boolean('creatable')->default(0);
            $table->boolean('transferable')->default(0);
            $table->integer('turns')->default(0);
            $table->double('interest', 15, 8)->default(0);
            $table->boolean('requires_storage')->default(0);
            $table->boolean('global')->default(0);
            $table->boolean('production_resource')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resources');
    }
}
