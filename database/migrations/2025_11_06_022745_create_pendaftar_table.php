<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->increments('pendaftar_id');
            $table->unsignedInteger('program_id');
            $table->unsignedInteger('warga_id');
            $table->enum('status_seleksi', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('program_id')
                ->references('program_id')
                ->on('program')
                ->onDelete('cascade');

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
