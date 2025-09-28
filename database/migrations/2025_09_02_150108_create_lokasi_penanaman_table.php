<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lokasi_penanaman', function (Blueprint $table) {
            $table->id();
           $table->string('nama_lokasi')->unique();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->date('tanggal_penanaman')->nullable();
            $table->text('deskripsi')->nullable();
            $table->json('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_penanaman');
    }
};
