<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->string('phone')->nullable()->after('username');
            $table->string('country')->nullable()->after('phone');
            $table->decimal('balance', 15, 2)->default(0)->after('country');
            $table->string('referral_code')->unique()->after('balance');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'phone', 'country', 'balance', 'referral_code']);
        });
    }
};