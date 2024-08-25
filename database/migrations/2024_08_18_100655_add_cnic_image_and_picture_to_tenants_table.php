<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('cnic_image')->nullable(); // Path to CNIC image
            $table->string('picture')->nullable();    // Path to tenant's picture
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['cnic_image', 'picture']);
        });
    }
};
