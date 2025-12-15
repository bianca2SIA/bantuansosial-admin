<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->increments('riwayat_id');

            $table->unsignedInteger('program_id');
            $table->foreign('program_id')
                ->references('program_id')
                ->on('program')
                ->onDelete('cascade');

            $table->unsignedInteger('penerima_id');
            $table->foreign('penerima_id')
                ->references('penerima_id')
                ->on('penerima')
                ->onDelete('cascade');

            $table->integer('tahap_ke');
            $table->date('tanggal');
            $table->decimal('nilai', 12, 2);

            $table->string('bukti_penyaluran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
