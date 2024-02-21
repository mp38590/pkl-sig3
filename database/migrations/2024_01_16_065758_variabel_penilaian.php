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
        Schema::create('variabel_penilaian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_variabel_penilaian')->nullable();
            $table->string('versi', 5);
            $table->string('item_penilaian', 500);
            $table->string('deskripsi_item_penilaian', 2000);
            $table->string('kode_penilaian', 10);
            $table->integer('nilai_maksimal');
            $table->string('status', 50)->nullable();
            $table->string('inserted_by', 25)->nullable();
            $table->string('updated_by', 25)->nullable();
            $table->integer('flag_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variabel_penilaian');
    }
};
