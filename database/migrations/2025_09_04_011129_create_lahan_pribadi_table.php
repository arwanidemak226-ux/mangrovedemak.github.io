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
        Schema::create('lahan_pribadi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('alamat')->nullable();
            $table->decimal('luas_ha', 8, 2)->nullable();
            $table->string('status_lahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan_pribadi');
    }
};
