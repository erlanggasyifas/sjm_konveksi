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
        Schema::create('tenaga_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tenaga_kerja')->unique();
            $table->string('nama_tenaga_kerja');
            $table->decimal('upah', 10, 2);
            $table->string('bagian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_kerja');
    }
};
