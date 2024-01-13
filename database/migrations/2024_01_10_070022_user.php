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
        Schema::create('user', function (Blueprint $table) {
            $table->id('username')->unique();
            $table->string('nama', 30)->nullable(false);
            $table->string('nik', 16)->nullable();
            $table->string('email', 30)->nullable(false);
            $table->string('noHp', 13)->nullable();
            $table->string('alamat_rumah', 50)->nullable();
            $table->string('jabatan', 30)->nullable();
            $table->string('level', 30)->nullable(false);
            $table->string('no_rekening', 16)->nullable();
            $table->string('password', 20)->nullable(false);
            $table->string('foto', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
