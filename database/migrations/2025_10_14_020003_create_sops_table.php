<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama alat
            $table->string('kode')->unique(); // kode alat
            $table->date('tanggal_kadaluarsa'); // tanggal kadaluarsa
            $table->string('vendor')->nullable(); // vendor (opsional)
            $table->string('file_pdf')->nullable(); // file PDF (opsional)
            $table->integer('rev')->default(1); // revision
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sops');
    }
};
