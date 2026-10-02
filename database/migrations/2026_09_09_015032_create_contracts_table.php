<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {

            $table->id();

            // =====================================================
            // CONTRACT INFORMATION
            // =====================================================

            $table->string('contract_number')->unique();
            $table->string('verify_token', 36)->nullable()->unique();
            $table->date('contract_date');
            $table->string('category')->nullable();
            $table->string('type')->nullable();
            $table->string('title');


            // =====================================================
            // RELATION
            // =====================================================

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('hrd_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('head_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            // =====================================================
            // EMPLOYEE SNAPSHOT
            // =====================================================

            $table->string('employee_name');
            $table->string('department')->nullable();
            $table->string('nik')->nullable();
            $table->string('ktp_number')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedTinyInteger('age_at_contract')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();


            // =====================================================
            // CONTRACT PERIOD
            // =====================================================

            $table->date('start_date');
            $table->date('end_date');


            // =====================================================
            // POSITION & PLACEMENT
            // =====================================================

            $table->string('position')->nullable();
            $table->string('work_location')->nullable();
            $table->string('domicile')->nullable();


            // =====================================================
            // SALARY
            // =====================================================

            $table->decimal('basic_salary', 15, 2)->nullable();


            // =====================================================
            // ALLOWANCES
            // =====================================================

            $table->decimal('project_allowance', 15, 2)->nullable();
            $table->decimal('cost_allowance', 15, 2)->nullable();
            $table->decimal('meal_allowance', 15, 2)->nullable();
            $table->decimal('transport_allowance', 15, 2)->nullable();
            $table->decimal('functional_allowance', 15, 2)->nullable();
            $table->decimal('security_incentive', 15, 2)->nullable();
            $table->decimal('night_shift_allowance', 15, 2)->nullable();
            $table->decimal('sea_allowance', 15, 2)->nullable();
            $table->decimal('pulse_allowance', 15, 2)->nullable();
            $table->decimal('attendance_allowance', 15, 2)->nullable();


            // =====================================================
            // CONTRACT DOCUMENT
            // =====================================================

            $table->string('file_path')->nullable();


            // =====================================================
            // CONTRACT STATUS
            // =====================================================

            $table->enum('status', [
                'draft',
                'sent',
                'viewed',
                'signed',
                'signed-hrd',
                'signed-head',
                'expired',
            ])->default('draft');


            // =====================================================
            // EMPLOYEE SIGNATURE
            // =====================================================

            $table->string('employee_signature')->nullable();
            $table->timestamp('employee_signed_at')->nullable();


            // =====================================================
            // HRD SIGNATURE + QR
            // =====================================================

            $table->string('hrd_signature')->nullable();
            $table->timestamp('hrd_signed_at')->nullable();
            $table->string('hrd_qr_path')->nullable();


            // =====================================================
            // HEAD OF BRANCH SIGNATURE + QR
            // =====================================================

            $table->string('head_signature')->nullable();
            $table->timestamp('head_signed_at')->nullable();
            $table->string('head_qr_path')->nullable();


            // =====================================================
            // AUDIT
            // =====================================================

            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};