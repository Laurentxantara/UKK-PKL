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
        Schema::create('industri', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang_usaha');
            $table->text('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            // $table->foreignId('guru_pembimbing')->nullable()->constrained('guru')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industri');
    }
};
