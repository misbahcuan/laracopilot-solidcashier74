<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->string('strategy')->default('manual')->after('status');
        });
    }

    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('strategy');
        });
    }
};