<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->decimal('balance', 15, 2)->default(0)->after('password');
            $table->string('referral_code', 20)->unique()->after('balance');
            $table->string('phone', 20)->nullable()->after('referral_code');
            $table->string('country', 100)->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'balance', 'referral_code', 'phone', 'country']);
        });
    }
};