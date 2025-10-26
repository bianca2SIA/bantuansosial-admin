<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->increments('warga_id'); // Primary Key, auto increment
            $table->string('no_ktp', 20)->unique(); // Nomor KTP unik
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('telp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
