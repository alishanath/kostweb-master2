<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaPemesanan;

class NotifikasiController extends Controller
{
    public function kirimEmail($id)
    {
        $notifikasi = \App\Models\KelolaPemesanan::with('penghuni', 'kamar')->findOrFail($id);
        $email = $notifikasi->penghuni->email ?? null;

        if ($email) {
            try {
                \Mail::to($email)->send(new \App\Mail\ReminderSewa($notifikasi));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Email pengingat berhasil dikirim!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim email. ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email tidak ditemukan.'
        ], 404);
    }
}
