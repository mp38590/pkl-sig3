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
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id('objective_id')->unique();
            $table->string('objective', 500)->nullable(false);
            $table->string('kebutuhan_dokumen', 500)->nullable(false);
            $table->string('deskripsi', 500)->nullable(false);
            $table->string('file', 150)->nullable(false);
            $table->string('status', 100)->nullable();
            $table->string('skor_final', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi');
    }
};
