<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {

            // Security
            $table->decimal('security_incentive', 15, 2)
                ->nullable()
                ->after('functional_allowance');

            $table->decimal('night_shift_allowance', 15, 2)
                ->nullable()
                ->after('security_incentive');

            // gp-um-ut-laut
            $table->decimal('sea_allowance', 15, 2)
                ->nullable()
                ->after('night_shift_allowance');

            // gp-mahal-um-ut-fungsi-pls
            $table->decimal('pulse_allowance', 15, 2)
                ->nullable()
                ->after('sea_allowance');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn([
                'security_incentive',
                'night_shift_allowance',
                'sea_allowance',
                'pulse_allowance',
            ]);
        });
    }
};