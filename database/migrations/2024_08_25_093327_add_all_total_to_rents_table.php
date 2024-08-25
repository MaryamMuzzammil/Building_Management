<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->decimal('all_total', 8, 2)->nullable(); // Adjust the precision and scale as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent', function (Blueprint $table) {
            $table->dropColumn('all_total');
        });
    }
};
