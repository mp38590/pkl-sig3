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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('username', 50);
            $table->string('nik', 16)->nullable();
            $table->string('email', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('alamat_rumah', 50)->nullable();
            $table->string('jabatan', 25)->nullable();
            $table->string('level', 25);
            $table->string('no_rekening', 30)->nullable();
            $table->string('password', 100);
            $table->string('konfirm_password', 100);
            $table->string('foto', 50)->nullable();
            $table->string('inserted_by', 25)->nullable();
            $table->string('updated_by', 25)->nullable();
            $table->integer('flag_delete');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
