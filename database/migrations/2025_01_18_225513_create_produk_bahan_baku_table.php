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
        Schema::create('produk_bahan_baku', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')
                  ->references('id')
                  ->on('produks')
                  ->onDelete('no action');
            
            $table->unsignedBigInteger('bahan_baku_id');
            $table->foreign('bahan_baku_id')
                  ->references('id')
                  ->on('bahan_bakus')
                  ->onDelete('no action');
            
            $table->bigInteger('jumlah_bahan_baku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_bahan_baku');
    }
};
