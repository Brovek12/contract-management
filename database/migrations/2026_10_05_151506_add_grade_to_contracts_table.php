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
        Schema::table('contracts', function (Blueprint $table) {
            // Kolom grade (opsional, nullable)
            $table->string('grade')->nullable()->after('position');
            
            // Kalau mau enum, pakai ini sebagai gantinya:
            // $table->enum('grade', ['A', 'B', 'C', 'D'])->nullable()->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('grade');
        });
    }
};