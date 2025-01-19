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
        Schema::create('produk_overhead', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')
                  ->references('id')
                  ->on('produks')
                  ->onDelete('no action');

            $table->unsignedBigInteger('overhead_id');
            $table->foreign('overhead_id')
                  ->references('id')
                  ->on('overhead_pabriks')
                  ->onDelete('no action');
            
            $table->bigInteger('jumlah_overhead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_overhead');
    }
};
