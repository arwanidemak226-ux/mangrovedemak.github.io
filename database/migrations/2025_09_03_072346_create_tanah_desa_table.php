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
        Schema::create('tanah_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lahan');
            $table->string('alamat')->nullable();
            $table->decimal('luas_ha', 8, 2)->nullable();
            $table->string('status_kepemilikan');
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
        Schema::dropIfExists('tanah_desa');
    }
};
