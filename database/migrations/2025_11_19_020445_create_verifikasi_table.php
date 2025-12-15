<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id('verifikasi_id');

            $table->unsignedInteger('pendaftar_id');
            $table->foreign('pendaftar_id')
                ->references('pendaftar_id')
                ->on('pendaftar')
                ->cascadeOnDelete();

            $table->string('petugas');
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->integer('skor');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verifikasi');
    }
};
