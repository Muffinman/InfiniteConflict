<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddPlanetAndQueueLimits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rulers', function ($table) {
            $table->integer('queue_limit')->default(3)->after('password');
            $table->integer('planet_limit')->default(4)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rulers', function ($table) {
            $table->dropColumn('queue_limit');
            $table->dropColumn('planet_limit');
        });
    }
}
