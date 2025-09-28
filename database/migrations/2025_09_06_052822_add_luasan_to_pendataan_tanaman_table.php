<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendataan_tanaman', function (Blueprint $table) {
            $table->decimal('luasan', 10, 2)->nullable()->after('anggaran');
        });
    }

    public function down(): void
    {
        Schema::table('pendataan_tanaman', function (Blueprint $table) {
            $table->dropColumn('luasan');
        });
    }
};
