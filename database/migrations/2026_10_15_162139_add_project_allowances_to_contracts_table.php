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
            // ADDITIONAL ALLOWANCES
            // =====================================================

            // Tunj. Jabatan — untuk 3 type All In
            // (eni-smallcapital-all-in, warlok-all-in, lawe-lawe-all-in)
            $table->decimal('position_allowance', 15, 2)
                ->nullable()
                ->after('functional_allowance');

            // =====================================================
            // SAND MONITORING ALLOWANCES
            // =====================================================

            // Housing — untuk Sand Monitoring
            $table->decimal('housing_allowance', 15, 2)
                ->nullable()
                ->after('position_allowance');

            // EWHC — untuk Sand Monitoring
            $table->decimal('ewhc_allowance', 15, 2)
                ->nullable()
                ->after('housing_allowance');

            // Daily Allowance — untuk Sand Monitoring
            $table->decimal('daily_allowance', 15, 2)
                ->nullable()
                ->after('ewhc_allowance');

            // Annual Leave Allowance — untuk Sand Monitoring
            $table->decimal('annual_leave_allowance', 15, 2)
                ->nullable()
                ->after('daily_allowance');

            // Severance / Complement — untuk Sand Monitoring
            $table->decimal('severance_allowance', 15, 2)
                ->nullable()
                ->after('annual_leave_allowance');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn([
                'position_allowance',
                'housing_allowance',
                'ewhc_allowance',
                'daily_allowance',
                'annual_leave_allowance',
                'severance_allowance',
            ]);
        });
    }
};