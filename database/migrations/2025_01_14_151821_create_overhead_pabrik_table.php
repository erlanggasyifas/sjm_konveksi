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
        Schema::create('overhead_pabrik', function (Blueprint $table) {
            $table->id();
            $table->string('kode_overhead')->unique();
            $table->string('nama_overhead');
            $table->string('satuan');
            $table->decimal('harga_satuan', 10, 2);
            $table->enum('keterangan', ['Tetap', 'Variable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overhead_pabrik');
    }
};
