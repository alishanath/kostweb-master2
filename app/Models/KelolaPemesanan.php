<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaPemesanan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'kelola_pemesanan';

    // Menentukan kolom-kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'penghuni_id',  // ID Penghuni yang melakukan pemesanan
        'kamar_id',     // ID Kamar yang dipesan
        'tanggal_sewa', // Tanggal sewa kamar
        'bukti_pembayaran', // Bukti pembayaran
        'status',        // Status pemesanan (Menunggu, Diterima, Ditolak)
    ];

    // Relasi ke model User (Penghuni)
    public function penghuni()
    {
        return $this->belongsTo(User::class, 'penghuni_id');  // Penghuni yang memesan
    }


    // Relasi ke model KelolaKamar (Kamar)
    public function kamar()
    {
        return $this->belongsTo(KelolaKamar::class, 'kamar_id');  // Kamar yang dipesan
    }
}

