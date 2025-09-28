<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendataan_tanaman', function (Blueprint $table) {
            $table->string('dokumentasi')->nullable()->after('catatan'); 
            // kalau mau simpan multiple file lebih aman pakai json
            // $table->json('dokumentasi')->nullable()->after('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('pendataan_tanaman', function (Blueprint $table) {
            $table->dropColumn('dokumentasi');
        });
    }
};
