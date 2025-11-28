<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->increments('riwayat_id'); // PK

            // FK ke program
            $table->unsignedInteger('program_id');
            $table->foreign('program_id')
                ->references('program_id')
                ->on('program')
                ->onDelete('cascade');

            // FK ke penerima
            $table->unsignedInteger('penerima_id');
            $table->foreign('penerima_id')
                ->references('penerima_id')
                ->on('penerima')
                ->onDelete('cascade');

            $table->integer('tahap_ke');     // contoh: tahap 1, tahap 2
            $table->date('tanggal');         // tanggal penyaluran
            $table->decimal('nilai', 12, 2); // nilai bantuan

            // Bukti penyaluran → file foto / pdf
            $table->string('bukti_penyaluran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
