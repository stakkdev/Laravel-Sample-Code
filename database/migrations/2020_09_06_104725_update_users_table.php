<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable();
            $table->string('social_id')->nullable();
            $table->tinyInteger('login_type')->nullable()->default(4);
            $table->string('country_code', 4)->nullable();
            $table->string('phone_number', 12)->nullable();
            $table->string('country_iso_code', 3)->nullable();
            $table->boolean('verified')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
            $table->dropColumn('social_id');
            $table->dropColumn('login_type');
            $table->dropColumn('country_code', 4);
            $table->dropColumn('phone_number', 12);
            $table->dropColumn('country_iso_code', 3);
            $table->dropColumn('verified');
        });
    }
}
