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


            // =====================================================
            // RELATION
            // =====================================================

            // Employee yang menerima kontrak
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Project tempat employee ditempatkan
            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            // Head of Branch / pihak pertama yang menandatangani
            $table->foreignId('head_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            // =====================================================
            // EMPLOYEE SNAPSHOT
            // Data disimpan berdasarkan kondisi employee
            // ketika contract dibuat
            // =====================================================

            $table->string('employee_name');
            $table->string('type')->nullable();

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

            // Alamat berdasarkan data pada contract
            $table->text('address')->nullable();


            // =====================================================
            // CONTRACT PERIOD
            // PASAL 1
            // =====================================================

            $table->date('start_date');

            $table->date('end_date');


            // =====================================================
            // POSITION & PLACEMENT
            // PASAL 3 & PASAL 4
            // =====================================================

            // Jabatan / posisi pekerja
            $table->string('position')->nullable();

            // Lokasi kerja
            $table->string('work_location')->nullable();

            // Domisili employee
            $table->string('domicile')->nullable();


            // =====================================================
            // SALARY
            // PASAL 5
            // =====================================================

            $table->decimal('basic_salary', 15, 2)->nullable();


            // =====================================================
            // CONTRACT DOCUMENT
            // =====================================================

            $table->string('title');

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
                'expired',
            ])->default('draft');


            // =====================================================
            // EMPLOYEE SIGNATURE
            // =====================================================

            // Path gambar tanda tangan employee
            $table->string('signature')->nullable();

            $table->timestamp('signed_at')->nullable();


            // =====================================================
            // HEAD OF BRANCH SIGNATURE
            // =====================================================

            // Path gambar tanda tangan Head of Branch
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