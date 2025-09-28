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
        Schema::create('persediaan_tanaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_tanaman_id')->constrained('stok_tanaman')->cascadeOnDelete();
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
            $table->integer('sisa_stok')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_tanaman');
    }
};
