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
        Schema::create('monthly_tanaman_summaries', function (Blueprint $table) {
            $table->id();
           $table->foreignId('spesies_id')->constrained('spesies')->cascadeOnDelete();
        $table->unsignedSmallInteger('year');
        $table->unsignedTinyInteger('month');
        $table->unsignedBigInteger('total_tanaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_tanaman_summaries');
    }
};
