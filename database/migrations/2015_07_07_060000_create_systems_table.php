<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('galaxy_id')->unsigned();
            $table->integer('rows')->default(0);
            $table->integer('cols')->default(0);
            $table->integer('type')->default(0);
            $table->boolean('home')->default(0);
            $table->integer('col');
            $table->integer('row');
            $table->foreign('galaxy_id')->references('id')->on('galaxies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropForeign('systems_galaxy_id_foreign');
        });
        Schema::drop('systems');
    }
}
