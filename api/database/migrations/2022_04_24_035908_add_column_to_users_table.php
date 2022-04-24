<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('phone_number')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone_number');
            $table->date('birthday')->nullable()->after('gender');
            $table->string('address')->nullable()->after('birthday');
            $table->string('profile_photo_url')->nullable()->after('address');
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
            $table->dropColumn('name');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('profile_photo_url');
        });
    }
};
