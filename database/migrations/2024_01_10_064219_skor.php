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
        Schema::create('skor', function (Blueprint $table) {
            $table->id('objective_id')->unique();
            $table->string('file', 150)->nullable(false);
            $table->string('format_file', 150)->nullable(false);
            $table->string('skor_maksimal', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor');
    }
};
