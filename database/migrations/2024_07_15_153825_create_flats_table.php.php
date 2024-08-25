<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->integer('flat_number')->primary();
            $table->integer('floor_number');
            $table->integer('total_rooms');
            $table->decimal('sq_ft_area', 10, 2);
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            $table->timestamps();
        });

        // Adding the check constraint using raw SQL
        DB::statement('ALTER TABLE flats ADD CONSTRAINT chk_floor_number CHECK (floor_number BETWEEN 1 AND 5)');
    }

    public function down()
    {
        Schema::table('flats', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
        });

        Schema::dropIfExists('flats');
    }
};
