<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rulers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->bigInteger('asset_score')->unsigned()->default(0);
            $table->bigInteger('combat_score')->unsigned()->default(0);
            $table->integer('asset_rank')->nullable();
            $table->integer('combat_rank')->nullable();
            $table->integer('alliance_leaving')->nullable();
            $table->integer('alliance_cooldown')->nullable();
            $table->integer('alliance_id')->nullable()->unsigned();
            $table->integer('alliance_level')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rulers');
    }
}
