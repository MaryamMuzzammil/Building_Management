<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAmountToRentTable extends Migration
{
    public function up()
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->after('paid_rent')->nullable(); // Add total_amount column
        });
    }

    public function down()
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->dropColumn('total_amount'); // Remove total_amount column
        });
    }
}
