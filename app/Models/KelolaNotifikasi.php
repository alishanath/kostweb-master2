<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaNotifikasi extends Model
{
    use HasFactory;

    protected $table = 'kelola_notifikasi';

    protected $fillable = [
        'nama_penghuni',
        'nomor_kamar',
        'email',
        'tanggal_mulai_sewa',
        'jatuh_tempo_pembayaran',
    ];

    public function kamar()
    {
        return $this->belongsTo(KelolaKamar::class, 'nomor_kamar', 'no_kamar');
    }
}
