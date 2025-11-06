<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pendaftar', function (Blueprint $table) {
        $table->increments('pendaftar_id'); // PK
        $table->unsignedInteger('program_id'); // FK ke program
        $table->unsignedInteger('warga_id');   // FK ke warga
        $table->enum('status_seleksi', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
        $table->timestamps();

        // Foreign key constraints
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


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
