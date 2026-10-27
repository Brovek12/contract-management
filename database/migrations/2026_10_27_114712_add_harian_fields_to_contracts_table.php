<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            // Tambahkan kolom baru setelah 'basic_salary' atau bebas
            $table->integer('work_hours')->nullable()->after('basic_salary');
            $table->integer('break_hours')->nullable()->after('work_hours');
            $table->integer('work_days')->nullable()->after('break_hours');
            $table->integer('off_days')->nullable()->after('work_days');
            $table->string('payment_date', 10)->nullable()->after('off_days');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn(['work_hours', 'break_hours', 'work_days', 'off_days', 'payment_date']);
        });
    }
};