<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('media_id');
            $table->string('ref_table');
            $table->unsignedInteger('ref_id');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }

};
