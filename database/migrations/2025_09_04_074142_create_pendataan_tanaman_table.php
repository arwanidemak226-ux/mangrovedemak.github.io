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
        Schema::create('pendataan_tanaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_id')->constrained('lokasi_penanaman')->cascadeOnDelete();
            $table->foreignId('spesies_id')->constrained('spesies')->cascadeOnDelete();
            $table->foreignId('kelompok_pengampu_id')->constrained('kelompok_pengampu')->cascadeOnDelete();
            $table->string('anggaran')->nullable();
            $table->date('tanggal_pendataan')->nullable();
            $table->integer('jumlah_tanaman')->nullable();
            $table->decimal('tinggi_rata_rata', 8, 2)->nullable();
            $table->string('kondisi_tanaman')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendataan_tanaman');
    }
};
