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
        Schema::create('stok_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spesies_id')->constrained('spesies')->cascadeOnDelete();
            $table->string('nama_pemohon');
            $table->string('nik', 20); 
            $table->integer('jumlah_keluar')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_keluar');
    }
};
