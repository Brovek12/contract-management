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

            // Tanggal yang tercantum pada bagian pembukaan kontrak
            $table->date('contract_date');

            // Kategori besar contract
            // managerial | non-managerial | project
            $table->string('category')->nullable();

            // Varian spesifik di dalam kategori
            // contoh: all-in, gp-um-ut-fungsi, gp-mahal-um-ut-fungsi,
            //         security, ob, dst
            $table->string('type')->nullable();

            $table->string('title');


            // =====================================================
            // RELATION
            // =====================================================

            // Employee yang menerima contract
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Project tempat employee ditempatkan
            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            // HRD yang membuat / bertanggung jawab
            $table->foreignId('hrd_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Head of Branch / pihak pertama
            $table->foreignId('head_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            // =====================================================
            // EMPLOYEE SNAPSHOT
            // Data employee ketika contract dibuat
            // =====================================================

            $table->string('employee_name');

            $table->string('department')->nullable();

            // NIK kependudukan
            $table->string('nik')->nullable();

            // Nomor KTP
            $table->string('ktp_number')->nullable();

            // Tempat lahir
            $table->string('birth_place')->nullable();

            // Tanggal lahir
            $table->date('birth_date')->nullable();

            // Umur ketika contract dibuat
            $table->unsignedTinyInteger('age_at_contract')->nullable();

            // male / female
            $table->string('gender')->nullable();

            // Alamat berdasarkan contract
            $table->text('address')->nullable();


            // =====================================================
            // CONTRACT PERIOD
            // =====================================================

            $table->date('start_date');

            $table->date('end_date');


            // =====================================================
            // POSITION & PLACEMENT
            // =====================================================

            // Jabatan / posisi pekerja
            $table->string('position')->nullable();

            // Lokasi kerja
            $table->string('work_location')->nullable();

            // Domisili employee
            $table->string('domicile')->nullable();


            // =====================================================
            // SALARY
            // =====================================================

            $table->decimal('basic_salary', 15, 2)->nullable();


            // =====================================================
            // ALLOWANCES
            // Nullable, hanya diisi sesuai type contract
            // =====================================================

            // all-in
            $table->decimal('project_allowance', 15, 2)->nullable();

            // gp-mahal-um-ut-fungsi
            $table->decimal('cost_allowance', 15, 2)->nullable();

            // per hari masuk kerja
            $table->decimal('meal_allowance', 15, 2)->nullable();
            $table->decimal('transport_allowance', 15, 2)->nullable();
            $table->decimal('functional_allowance', 15, 2)->nullable();


            // =====================================================
            // CONTRACT DOCUMENT
            // =====================================================

            // PDF contract jika menggunakan upload
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
            // HRD SIGNATURE
            // =====================================================

            $table->string('hrd_signature')->nullable();

            $table->timestamp('hrd_signed_at')->nullable();


            // =====================================================
            // HEAD OF BRANCH SIGNATURE
            // =====================================================

            $table->string('head_signature')->nullable();

            $table->timestamp('head_signed_at')->nullable();


            // =====================================================
            // AUDIT
            // =====================================================

            // User yang membuat contract
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