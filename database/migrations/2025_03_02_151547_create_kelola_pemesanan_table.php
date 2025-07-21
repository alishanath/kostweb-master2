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
        Schema::create('kelola_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->unsignedBigInteger('penghuni_id');
            $table->unsignedBigInteger('kamar_id');
            $table->date('tanggal_sewa');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak']);
            $table->string('jumlah_penghuni');
            $table->string('tipe_pembayaran');
            $table->decimal('total_pembayaran');

            $table->timestamps();


            $table->foreign('penghuni_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kamar_id')->references('id')->on('kelola_kamar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_pemesanan');
    }
};
