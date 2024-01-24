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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian', 10)->nullable();
            $table->string('objective', 500)->nullable();
            $table->string('item_penilaian', 500)->nullable();
            $table->string('deskripsi_item_penilaian', 500)->nullable();
            $table->string('nama_dokumen', 150)->nullable();
            $table->string('format_file', 150)->nullable();
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
        Schema::dropIfExists('dokumen');
    }
};
