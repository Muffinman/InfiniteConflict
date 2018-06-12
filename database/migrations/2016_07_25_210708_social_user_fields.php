<?php

use Illuminate\Database\Migrations\Migration;

class SocialUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rulers', function ($table) {
            $table->string('social_provider')->nullable();
            $table->string('social_token')->nullable();
            $table->string('social_refresh_token')->nullable();
            $table->string('social_avatar')->nullable();
            $table->string('social_expires_at')->nullable();
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
            $table->dropColumn('social_provider');
            $table->dropColumn('social_token');
            $table->dropColumn('social_refresh_token');
            $table->dropColumn('social_avatar');
            $table->dropColumn('social_expires_at');
        });
    }
}
