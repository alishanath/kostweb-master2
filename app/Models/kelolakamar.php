<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaKamar extends Model
{
    use HasFactory;

    protected $table = 'kelola_kamar';
    protected $fillable = ['no_kamar', 'harga', 'deskripsi_kamar', 'fasilitas', 'gambar', 'status'];

    protected $casts = [
        'fasilitas' => 'array',
    ];

    public function pemesanan()
    {
        return $this->hasOne(KelolaPemesanan::class, 'kamar_id');
    }
}
