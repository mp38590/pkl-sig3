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
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 5)->nullable();
            $table->string('item_penilaian', 500)->nullable();
            $table->string('deskripsi_item_penilaian', 2000)->nullable();
            $table->string('kode_penilaian', 10)->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('objective_id')->nullable();
            $table->string('inserted_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
