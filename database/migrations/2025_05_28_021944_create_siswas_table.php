<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('email')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->string('kontak')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status_pkl', ['diterima', 'kosong'])->default('kosong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
