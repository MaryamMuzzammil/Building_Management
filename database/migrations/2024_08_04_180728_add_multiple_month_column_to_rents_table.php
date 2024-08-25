<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleMonthColumnToRentsTable extends Migration
{
    public function up()
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->string('multiple_month');
        });
    }

    public function down()
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->dropColumn('multiple_month');
        });
    }
}
