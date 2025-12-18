<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('program', function (Blueprint $table) {
            $table->increments('program_id');
            $table->string('kode')->unique();
            $table->string('nama_program', 150);
            $table->year('tahun');
            $table->text('deskripsi')->nullable();
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
