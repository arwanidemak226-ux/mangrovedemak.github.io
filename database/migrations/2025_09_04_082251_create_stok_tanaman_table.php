<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_tanaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spesies_id')->constrained('spesies')->cascadeOnDelete();
            $table->string('kode_stok')->nullable()->unique();
            $table->integer('jumlah_stok')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_tanaman');
    }
};
