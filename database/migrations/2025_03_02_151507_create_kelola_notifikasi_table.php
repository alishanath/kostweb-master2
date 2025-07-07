<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kelola_notifikasi', function (Blueprint $table) {
        $table->id();
        $table->string('nama_penghuni');
        $table->unsignedBigInteger('nomor_kamar');
        $table->string('email');
        $table->date('tanggal_mulai_sewa');
        $table->date('jatuh_tempo_pembayaran');
        $table->timestamps();

        $table->foreign('nomor_kamar')->references('id')->on('kelola_kamar')->onDelete('cascade');
    });
}
    public function down(): void
    {
        Schema::dropIfExists('kelola_notifikasi');
    }
};
