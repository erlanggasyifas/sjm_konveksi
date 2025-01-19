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
        Schema::create('produk_tenaga_kerja', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')
                  ->references('id')
                  ->on('produks')
                  ->onDelete('no action');
            
            $table->unsignedBigInteger('tenaga_kerja_id');
            $table->foreign('tenaga_kerja_id')
                  ->references('id')
                  ->on('tenaga_kerjas')
                  ->onDelete('no action');
            
            $table->bigInteger('jumlah_tenaga_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_tenaga_kerja');
    }
};
