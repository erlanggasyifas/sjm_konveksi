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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 255)->index();
            $table->string('nama_produk', 255);
            $table->unsignedBigInteger('bahan_baku_id')->index();
            $table->unsignedBigInteger('jumlah_bahan_baku');
            $table->unsignedBigInteger('overhead_id')->index();
            $table->unsignedBigInteger('jumlah_overhead');
            $table->unsignedBigInteger('tenaga_kerja_id')->index();
            $table->unsignedBigInteger('jumlah_tenaga_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
