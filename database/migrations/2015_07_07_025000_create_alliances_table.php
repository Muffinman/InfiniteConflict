<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->bigInteger('asset_score')->unsigned()->default(0);
            $table->bigInteger('combat_score')->unsigned()->default(0);
            $table->integer('asset_rank')->nullable();
            $table->integer('combat_rank')->nullable();
            $table->timestamps();
        });

        Schema::table('rulers', function (Blueprint $table) {
            // foreign keys
            $table->foreign('alliance_id')->references('id')->on('alliances')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rulers', function (Blueprint $table) {
            $table->dropForeign('rulers_alliance_id_foreign');
        });
        Schema::drop('alliances');
    }
}
