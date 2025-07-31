<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaKamar;
use App\Models\KelolaNotifikasi;
use App\Models\KelolaPemesanan;
use App\Models\KelolaPenghuni;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Menghitung total jumlah kamar
        $totalRooms = KelolaKamar::count();

        // Menghitung jumlah kamar dengan status yang sesuai
        $occupiedRooms = KelolaKamar::where('status', 'booked')->count();
        $availableRooms = KelolaKamar::where('status', 'available')->count();
        $maintenanceRooms = KelolaKamar::where('status', 'maintenance')->count();

        // Menghitung persentase kamar tersedia
        $availabilityPercentage = $totalRooms > 0
            ? round(($availableRooms / $totalRooms) * 100)
            : 0;

        // Mengambil 10 aktivitas terbaru
        $recentActivities = KelolaKamar::latest()->take(10)->get();

        // Menampilkan data ke view
        $tahun = Carbon::now()->year;

    $pendapatan = DB::table('kelola_pemesanan')
        ->select(
            DB::raw('MONTH(tanggal_sewa) as bulan'),
            DB::raw('SUM(total_pembayaran) as total')
        )
        ->whereYear('tanggal_sewa', $tahun)
        ->where('status', 'Diterima')
        ->groupBy(DB::raw('MONTH(tanggal_sewa)'))
        ->pluck('total', 'bulan')
        ->toArray();

    // Buat array 12 bulan (Jan - Des)
    $dataPendapatan = [];
    for ($i = 1; $i <= 12; $i++) {
        $dataPendapatan[] = isset($pendapatan[$i]) ? (float) $pendapatan[$i] : 0;
    }

    // Jika belum ada tabel biaya, pakai dummy (ganti jika ada tabel pengeluaran)
    $dataBiaya = [10, 12, 15, 18, 20, 22, 25, 23, 20, 22, 25, 28];

    // Kirim semua data ke view
    return view('admin.dashboard', compact(
        'totalRooms',
        'occupiedRooms',
        'availableRooms',
        'maintenanceRooms',
        'availabilityPercentage',
        'recentActivities',
        'dataPendapatan',
        'dataBiaya'
    ));
}

    // Kelola Kamar
    public function indexKamar(Request $request)
    {
        $query = KelolaKamar::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('no_kamar', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi_kamar', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('availability')) {
            $query->where('status', $request->availability);
        }

        $kamar = $query->paginate(10);

        return view('admin.room.main', compact('kamar'));
    }


    public function storeKamar(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'no_kamar' => 'required|unique:kelola_kamar',
            'harga' => 'required|numeric|min:0',
            'deskripsi_kamar' => 'required|string|max:500',
            'fasilitas' => 'required|array', // Make sure 'fasilitas' is an array (from checkboxes)
            'fasilitas.*' => 'string', // Validate each item in the 'fasilitas' array as a string
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', // Image validation
            'status' => 'in:available,booked', // Only allow 'available' or 'booked' status
            'kapasitas' => 'required|string|max:50', // Validate kapasitas

        ]);



        // Set the default status if not provided
        if (!isset($validated['status'])) {
            $validated['status'] = 'available';
        }

        try {
            // Check if the request has a file for 'gambar' and store it
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('kamar', 'public');
                $validated['gambar'] = $path;
            }

            // Convert the 'fasilitas' array into a comma-separated string
            $validated['fasilitas'] = implode(', ', $validated['fasilitas']);

            // Create a new 'KelolaKamar' record with the validated data
            KelolaKamar::create($validated);

            // Redirect back to 'kamar' with a success message
            return redirect()->route('kamar')->with('success', 'Kamar berhasil ditambahkan');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with error message
            dd($e);
            return back()->withInput()->with('error', 'Gagal menambahkan kamar: '.$e->getMessage());
        }
    }


    public function updateKamar(Request $request, $id)
    {
        // Validate the request data with more flexible rules
        $validated = $request->validate([
            'no_kamar' => 'required|unique:kelola_kamar,no_kamar,' . $id,
            'harga' => 'required|numeric|min:100000',
            'deskripsi_kamar' => 'required|string|max:500',
            'fasilitas' => 'nullable|array', // Changed to nullable
            'fasilitas.*' => 'string|in:AC,WiFi,TV,Kulkas,kipas',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,booked', // Added maintenance option
            'kapasitas' => 'required|string|max:50', // Validate kapasitas

        ]);

        DB::beginTransaction();
        try {
            $kamar = KelolaKamar::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($kamar->gambar) {
                    Storage::disk('public')->delete($kamar->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('kamar', 'public');
            }

            // Handle fasilitas - only update if provided
            if (isset($validated['fasilitas'])) {
                $kamar->fasilitas = implode(',', $validated['fasilitas']);
                unset($validated['fasilitas']);
            }

            // Update other fields
            $kamar->update($validated);

            DB::commit();

            return redirect()->route('kamar')
                ->with('success', 'Data kamar berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal memperbarui kamar: ' . $e->getMessage());
        }
    }




    public function editKamar($id)
    {
        $kamar = KelolaKamar::findOrFail($id);
        return view('admin.room.edit', compact('kamar'));
    }



    public function destroyKamar($id)
    {
        try {
            $kamar = KelolaKamar::findOrFail($id);

            // Hapus gambar terkait
            if ($kamar->gambar) {
                Storage::disk('public')->delete($kamar->gambar);
            }

            $kamar->delete();
            return redirect()->route('kamar')->with('success', 'Kamar berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kamar: '.$e->getMessage());
        }
    }

    // Kelola Notifikasi

    public function indexNotifikasi()
    {
        // Contoh ambil data dengan relasi user dan kamar
        $notifikasi = KelolaPemesanan::with(['penghuni', 'kamar'])
                        ->where('status', 'diterima')
                        ->paginate(10);

        return view('admin.notification.main', compact('notifikasi'));
    }

    // public function indexNotifikasi(Request $request)
    // {
    //         $query = KelolaNotifikasi::query();

    //         if ($request->has('search')) {
    //             $query->where('judul', 'like', '%'.$request->search.'%')
    //                 ->orWhere('pesan', 'like', '%'.$request->search.'%');
    //         }

    //         $notifikasi = $query->paginate(10);
    //         return view('admin.notification.main', compact('notifikasi'));

    // }

    public function indexPemesanan(Request $request)
    {
        $query = KelolaPemesanan::with(['kamar', 'penghuni']);

        // Filter pencarian
        if ($request->has('search') && !empty($request->search)) {
        $searchTerm = '%' . $request->search . '%';

        $query->where(function ($q) use ($searchTerm) {
            $q->where('kode_booking', 'like', $searchTerm) // <-- Tambahan ini
              ->orWhereHas('kamar', function ($kamarQuery) use ($searchTerm) {
                  $kamarQuery->where('no_kamar', 'like', $searchTerm);
              })
              ->orWhereHas('penghuni', function ($penghuniQuery) use ($searchTerm) {
                  $penghuniQuery->where('name', 'like', $searchTerm);
              });
        });
    }

        // Filter tanggal sewa
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_sewa', [$request->start_date, $request->end_date]);
        }

        $pemesanan = $query->orderBy('created_at', 'desc')->paginate(10);

        $penghuni = User::whereIn('role', ['user', 'penghuni'])
                    ->orderBy('name')
                    ->get();

        $kamars = KelolaKamar::where('status', 'available')
                    ->orderBy('no_kamar')
                    ->get();

        return view('admin.order.main', compact('pemesanan', 'penghuni', 'kamars'));
    }


    // public function storePemesanan(Request $request)
    // {
    //     // ✅ Validasi input
    //     $validated = $request->validate([
    //         'penghuni_id' => 'required|exists:users,id',
    //         'kamar_id' => 'required|exists:kelola_kamar,id',
    //         'tanggal_sewa' => 'required|date',
    //         'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    //         'status' => 'required|in:Menunggu,Diterima,Ditolak',
    //         'jumlah_penghuni' => 'required|integer|min:1',
    //         'tipe_pembayaran' => 'required|string',
    //         'total_pembayaran' => 'required|numeric',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // ✅ Generate kode booking unik (sama seperti user)
    //         do {
    //             $randomString = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
    //             $kodeBooking = 'BK' . $randomString;
    //         } while (KelolaPemesanan::where('kode_booking', $kodeBooking)->exists());

    //         // ✅ Upload bukti pembayaran jika ada
    //         $path = null;
    //         if ($request->hasFile('bukti_pembayaran')) {
    //             $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    //         }

    //         // ✅ Simpan data pemesanan
    //         $pemesanan = KelolaPemesanan::create([
    //             'kode_booking' => $kodeBooking,
    //             'penghuni_id' => $validated['penghuni_id'],
    //             'kamar_id' => $validated['kamar_id'],
    //             'tanggal_sewa' => $validated['tanggal_sewa'],
    //             'bukti_pembayaran' => $path,
    //             'status' => $validated['status'],
    //             'jumlah_penghuni' => $validated['jumlah_penghuni'],
    //             'tipe_pembayaran' => $validated['tipe_pembayaran'],
    //             'total_pembayaran' => $validated['total_pembayaran'],
    //         ]);

    //         // ✅ Update status kamar jika pemesanan diterima
    //         if ($validated['status'] === 'Diterima') {
    //             KelolaKamar::where('id', $validated['kamar_id'])->update(['status' => 'booked']);
    //         }

    //         DB::commit();

    //         return redirect()->route('pemesanan')->with('success', 'Pemesanan berhasil disimpan.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         if ($path) {
    //             Storage::disk('public')->delete($path);
    //         }

    //         return back()->withInput()->with('error', 'Gagal menyimpan pemesanan: ' . $e->getMessage());
    //     }
    // }


    public function updatePemesanan(Request $request, $id)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'penghuni_id' => 'required|exists:users,id',
            'kamar_id' => 'required|exists:kelola_kamar,id',
            'tanggal_sewa' => 'required|date',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
            'jumlah_penghuni' => 'required|integer|min:1',
            'tipe_pembayaran' => 'required|string',
            'total_pembayaran' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $pemesanan = KelolaPemesanan::findOrFail($id);
            $oldPath = $pemesanan->bukti_pembayaran;
            $oldKamarId = $pemesanan->kamar_id; // ✅ Simpan kamar lama

            // ✅ Jika ada file baru diupload, hapus file lama
            $path = $oldPath;
            if ($request->hasFile('bukti_pembayaran')) {
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            // ✅ Update data pemesanan
            $pemesanan->update([
                'penghuni_id' => $validated['penghuni_id'],
                'kamar_id' => $validated['kamar_id'],
                'tanggal_sewa' => $validated['tanggal_sewa'],
                'bukti_pembayaran' => $path,
                'status' => $validated['status'],
                'jumlah_penghuni' => $validated['jumlah_penghuni'],
                'tipe_pembayaran' => $validated['tipe_pembayaran'],
                'total_pembayaran' => $validated['total_pembayaran'],
            ]);

            // ✅ Jika kamar diganti, ubah kamar lama menjadi available
            if ($oldKamarId != $validated['kamar_id']) {
                KelolaKamar::where('id', $oldKamarId)->update(['status' => 'available']);
            }

            // ✅ Update status kamar baru
            if ($validated['status'] === 'Diterima') {
                KelolaKamar::where('id', $validated['kamar_id'])->update(['status' => 'booked']);
            } elseif ($validated['status'] === 'Ditolak') {
                KelolaKamar::where('id', $validated['kamar_id'])->update(['status' => 'available']);
            }

            DB::commit();

            return redirect()->route('pemesanan')->with('success', 'Pemesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui pemesanan: ' . $e->getMessage());
        }
    }

    public function destroyPemesanan($id)
    {
        DB::beginTransaction();
        try {

            $pemesanan = KelolaPemesanan::findOrFail($id);
            $kamar_id = $pemesanan->kamar_id;


            $pemesanan->delete();

            KelolaKamar::where('id', $kamar_id)->update(['status' => 'available']);

            DB::commit();
            return redirect()->route('pemesanan')->with('success', 'Pemesanan berhasil dihapus dan kamar tersedia kembali');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus pemesanan: '.$e->getMessage());
        }
    }

    public function indexPenghuni(Request $request)
    {
        $search = $request->input('search');

        $penghuni = User::where('role', '!=', 'admin')
                    ->when($search, function($query) use ($search) {
                        return $query->where(function($q) use ($search) {
                            $q->where('name', 'like', '%'.$search.'%')
                              ->orWhere('no_hp', 'like', '%'.$search.'%');
                        });
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // 10 item per halaman

        return view('admin.penghuni.main', compact('penghuni'));
    }


    public function storePenghuni(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'no_hp'          => 'required|string|max:20|unique:users,no_hp',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
        ], [
            'email.unique'  => 'Email sudah terdaftar. Gunakan email lain.',
            'no_hp.unique'  => 'Nomor HP sudah digunakan. Gunakan nomor lain.',
        ]);

        try {
            // Generate username unik
            do {
                $username = Str::slug($validated['nama_lengkap']) . rand(100, 999);
            } while (User::where('username', $username)->exists());

            // Simpan data penghuni ke tabel `users`
            User::create([
                'name'           => $validated['nama_lengkap'],
                'username'       => $username,
                'email'          => $validated['email'],
                'no_hp'          => $validated['no_hp'],
                'tanggal_lahir'  => $validated['tanggal_lahir'],
                'alamat'         => $validated['alamat'],
                'role'           => 'user',
                'password'       => bcrypt('12345678'), // default password
            ]);



            return redirect()->route('users.index')->with('success', 'Penghuni berhasil ditambahkan sebagai user.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan penghuni: ' . $e->getMessage());
        }
    }


   public function updatePenghuni(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $id,
            'no_hp'          => 'required|string|max:20|unique:users,no_hp,' . $id,
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
        ], [
            'email.unique'  => 'Email sudah terdaftar. Gunakan email lain.',
            'no_hp.unique'  => 'Nomor HP sudah digunakan. Gunakan nomor lain.',
        ]);

        try {
            // Ambil data pengguna yang akan diupdate
            $user = User::findOrFail($id);

            // Generate username unik jika nama lengkap diubah
            if ($user->name !== $validated['nama_lengkap']) {
                do {
                    $username = Str::slug($validated['nama_lengkap']) . rand(100, 999);
                } while (User::where('username', $username)->exists());

                $user->username = $username;
            }

            // Perbarui data penghuni
            $user->update([
                'name'           => $validated['nama_lengkap'],
                'email'          => $validated['email'],
                'no_hp'          => $validated['no_hp'],
                'tanggal_lahir'  => $validated['tanggal_lahir'],
                'alamat'         => $validated['alamat'],
            ]);

            return redirect()->route('users.index')->with('success', 'Penghuni berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui penghuni: ' . $e->getMessage());
        }
    }




    public function destroyPenghuni($id)
    {
        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus user
            $user->delete();

            // Redirect ke halaman users dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'Penghuni berhasil dihapus.');
        } catch (\Exception $e) {
            // Kembali dengan pesan error jika ada masalah
            return back()->with('error', 'Gagal menghapus penghuni: ' . $e->getMessage());
        }
    }


}
