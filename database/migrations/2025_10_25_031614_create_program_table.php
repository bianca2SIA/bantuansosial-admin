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
        Schema::create('program', function (Blueprint $table) {
            $table->increments('program_id');               // Primary Key (auto increment)
            $table->string('kode')->unique();               // Kode unik
            $table->string('nama_program', 150);            // Nama program
            $table->year('tahun');                          // Tahun (misalnya 2025)
            $table->text('deskripsi')->nullable();          // Deskripsi program (boleh kosong)
            $table->decimal('anggaran', 15, 2)->default(0); // Anggaran dengan format desimal
            $table->timestamps();                           // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
