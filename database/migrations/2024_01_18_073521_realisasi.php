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
            $table->integer('id_variabel_penilaian')->nullable();
            $table->string('tahun', 5)->nullable();
            $table->string('item_penilaian', 500);
            $table->string('deskripsi_item_penilaian', 2000);
            $table->string('kode_penilaian', 10);
            $table->integer('nilai')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('inserted_by', 25);
            $table->string('updated_by', 25);
            $table->integer('flag_delete');
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
