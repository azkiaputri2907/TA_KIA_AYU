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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            // Kolom khusus nomor antrian/kunjungan (String biar bisa format "BK-001")
            $table->string('no_kunjungan'); 
            
            $table->string('nama');
            $table->string('nomor_induk')->nullable();
            $table->string('instansi')->nullable();
            $table->string('prodi');
            $table->text('keperluan');
            $table->string('status')->default('Selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
