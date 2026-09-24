<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {

            // =====================================================
            // ENI Muara Bakau (LEMBUR)
            // Uang Kehadiran (Makan & Transport) digabung
            // =====================================================
            $table->decimal('attendance_allowance', 15, 2)
                ->nullable()
                ->after('sea_allowance');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('attendance_allowance');
        });
    }
};
