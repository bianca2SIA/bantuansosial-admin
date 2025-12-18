<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima', function (Blueprint $table) {
            $table->increments('penerima_id');

            $table->unsignedInteger('program_id');
            $table->foreign('program_id')
                ->references('program_id')
                ->on('program')
                ->onDelete('cascade');

            $table->unsignedInteger('warga_id');
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');

            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima');
    }
};
