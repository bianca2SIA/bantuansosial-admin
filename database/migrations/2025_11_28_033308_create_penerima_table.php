<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima', function (Blueprint $table) {
            $table->increments('penerima_id');  // PK

            $table->unsignedInteger('program_id'); // FK ke program
            $table->foreign('program_id')
                  ->references('program_id')
                  ->on('program')
                  ->onDelete('cascade');

            $table->unsignedInteger('warga_id'); // FK ke warga
            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

            $table->string('keterangan')->nullable(); // tambahan opsional

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima');
    }
};
