<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {

            // Severance / Complement — untuk Sand Monitoring
        $table->timestamp('stopped_at')->nullable()->after('severance_allowance');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn([
                'stopped_at',
            ]);
        });
    }
};