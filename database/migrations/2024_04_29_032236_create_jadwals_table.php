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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Menambahkan kolom tanggal
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']); // Menambahkan kolom hari
            $table->string('tujuan');
            $table->integer('pemesanan_tiket')->default(0);
            $table->string('berkas_pencarian')->nullable();
            $table->boolean('pencairan')->default(false);
            $table->text('catatan')->nullable();
            $table->string('no_st_und')->nullable(); // Menambahkan kolom NO ST/UND
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};