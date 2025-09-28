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
        Schema::create('kelompok_pengampu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->string('nama');
            $table->string('kontak')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('sk_akta_notaris')->nullable();
            $table->string('sk_kepala_desa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_pengampu');
    }
};
