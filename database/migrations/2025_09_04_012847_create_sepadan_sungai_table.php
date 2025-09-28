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
        Schema::create('sepadan_sungai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sungai');
            $table->string('titik_koordinat')->nullable();
            $table->decimal('luas_m2', 10, 2)->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('status_kondisi')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepadan_sungai');
    }
};
