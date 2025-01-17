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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 255)->unique();
            $table->string('nama_produk', 255);
            $table->unsignedBigInteger('bahan_baku_id')->index();
            $table->unsignedBigInteger('jumlah_bahan_baku');
            $table->unsignedBigInteger('overhead_id')->index();
            $table->unsignedBigInteger('jumlah_overhead');
            $table->unsignedBigInteger('tenaga_kerja_id')->index();
            $table->unsignedBigInteger('jumlah_tenaga_kerja');
            $table->timestamps();

            $table->foreign('bahan_baku_id')
                  ->references('id')
                  ->on('bahan_bakus')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('overhead_id')
                  ->references('id')
                  ->on('overhead_pabriks')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('tenaga_kerja_id')
                  ->references('id')
                  ->on('tenaga_kerjas')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['bahan_baku_id']);
            $table->dropForeign(['overhead_id']);
            $table->dropForeign(['tenaga_kerja_id']);
        });

        Schema::dropIfExists('produks');
    }
};
