<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\KelolaKamar;
use App\Models\KelolaPemesanan; // Assuming you have a Room model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class AuthController extends Controller
{
    public function index(){
        $rooms = KelolaKamar::where('status', 'available')->take(3)->get();
        return view('user.home', compact('rooms'));

    }
    public function showLoginForm()
    {
        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->role === 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun admin tidak dapat login di halaman ini.',
                ]);
            }

            return redirect()->route('user.home')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }



    public function showRegisterForm()
    {
        return view('auth.user.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
            'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Automatically set the role to 'user' for new registrations
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => strtolower(str_replace(' ', '', $request->name)),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'user', // Default role
            'tanggal_lahir' => $request->tanggal_lahir,
            'password' => Hash::make($request->password),
            'ktp' => $request->file('ktp')->store('ktp', 'public'),
        ]);

        return redirect()->route('auth.user.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function Profile()
    {
        $user = Auth::user();
        return view('auth.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;

        if ($request->hasFile('ktp')) {
            // Delete old KTP file if exists
            if ($user->ktp) {
                \Storage::disk('public')->delete($user->ktp);
            }
            // Store new KTP file
            $user->ktp = $request->file('ktp')->store('ktp', 'public');
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function listRoom()
    {

        $rooms = KelolaKamar::paginate(10);

        return view('user.listroom', compact('rooms'));

    }

    public function detailRoom($id)
    {

        $room = KelolaKamar::findOrFail($id);

        return view('user.detailroom', compact('room'));
    }


    public function bookingroom(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        $request->validate([
            'room_id' => 'required|exists:kelola_kamar,id'
        ]);

        $room = KelolaKamar::findOrFail($request->query('room_id'));

        return view('user.booking', [
            'room' => $room,
            'photoUrl' => $room->gambar ? asset('storage/' . $room->gambar) : 'https://via.placeholder.com/800x500?text=No+Image'
        ]);
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:kelola_kamar,id',
            'tanggal_sewa' => 'required|date_format:Y-m-d',
            'jumlah_penghuni' => 'required|integer|min:1',
            'tipe_pembayaran' => 'required|string',
            'total_pembayaran' => 'required|numeric',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Generate kode booking unik
        do {
            $randomString = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
            $kodeBooking = 'BK' . $randomString;
        } while (KelolaPemesanan::where('kode_booking', $kodeBooking)->exists());

        $data = [
            'penghuni_id' => Auth::id(),
            'kamar_id' => $request->room_id,
            'tanggal_sewa' => Carbon::createFromFormat('Y-m-d', $request->tanggal_sewa),
            'status' => 'Menunggu',
            'jumlah_penghuni' => $request->jumlah_penghuni,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'total_pembayaran' => $request->total_pembayaran,
            'kode_booking' => $kodeBooking, // Tambahkan kode booking ke data
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
            $data['bukti_pembayaran'] = $path;
        }

        $booking = KelolaPemesanan::create($data);

        return redirect()->route('user.bookingconfirmation', ['bookingId' => $booking->id])
                        ->with('success', 'Booking berhasil dibuat.');
    }


    public function konfirmasiBooking($bookingId)
    {
        return view('user.bookingconfirmation');

    }

    // public function bookingroom(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login')
    //             ->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
    //     }

    //     $request->validate([
    //         'room_id' => 'required|exists:kelola_kamar,id'
    //     ]);

    //     $room = KelolaKamar::findOrFail($request->query('room_id'));

    //     return view('user.booking', [
    //         'room' => $room,
    //         'photoUrl' => $room->gambar ? asset('storage/' . $room->gambar) : 'https://via.placeholder.com/800x500?text=No+Image'
    //     ]);
    // }

    // public function prosesBooking(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'room_id' => 'required|exists:kelola_kamar,id',
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'no_hp' => 'required|string|max:20',
    //         'alamat' => 'required|string',
    //         'tanggal_sewa' => 'required|date_format:Y-m-d', // Pastikan format benar
    //         'total_pembayaran' => 'required|numeric',
    //         'jumlah_penghuni' => 'required|integer|min:1',
    //         'tipe_pembayaran' => 'required|string'
    //     ]);

    //     try {
    //         // Debugging opsional: Pastikan format benar
    //         // Log::info('Tanggal Sewa: ' . $request->tanggal_sewa);

    //         $booking = new KelolaPemesanan();
    //         $booking->penghuni_id = auth()->id();
    //         $booking->kamar_id = $request->room_id;

    //         // Simpan tanggal sesuai format (Y-m-d)
    //         $booking->tanggal_sewa = Carbon::createFromFormat('Y-m-d', $request->tanggal_sewa)->format('Y-m-d');

    //         $booking->bukti_pembayaran = null;
    //         $booking->status = 'Menunggu';
    //         $booking->jumlah_penghuni = $request->jumlah_penghuni;
    //         $booking->tipe_pembayaran = $request->tipe_pembayaran;
    //         $booking->total_pembayaran = $request->total_pembayaran;
    //         $booking->save();

    //         return redirect()->route('user.booking.confirmation')->with('success', 'Booking berhasil diproses!');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memproses booking: ' . $e->getMessage());
    //     }
    // }


    //  public function storeBooking(Request $request)
    // {
    //     $request->validate([
    //         'room_id' => 'required|exists:kelola_kamar,id',
    //         'tanggal_sewa' => 'required|date_format:Y-m-d',
    //         'jumlah_penghuni' => 'required|integer|min:1',
    //         'tipe_pembayaran' => 'required|string',
    //         'total_pembayaran' => 'required|numeric',
    //     ]);

    //     $data = [
    //         'penghuni_id' => Auth::id(),
    //         'kamar_id' => $request->room_id,
    //         'tanggal_sewa' => Carbon::createFromFormat('Y-m-d', $request->tanggal_sewa),
    //         'bukti_pembayaran' => null, // awalnya null
    //         'status' => 'Menunggu',
    //         'jumlah_penghuni' => $request->jumlah_penghuni,
    //         'tipe_pembayaran' => $request->tipe_pembayaran,
    //         'total_pembayaran' => $request->total_pembayaran,
    //     ];

    //     KelolaPemesanan::create($data);

    //     return redirect()->route('user.bookingconfirmation', ['bookingId' => $data['kamar_id']])
    //                      ->with('success', 'Booking berhasil dibuat.');
    // }

    // public function konfirmasiBooking($bookingId)
    // {
    //     $booking = KelolaPemesanan::with('kamar')
    //                 ->where('id', $bookingId)
    //                 ->where('penghuni_id', Auth::id())
    //                 ->firstOrFail();

    //     $room = $booking->kamar;

    //     $bankAccounts = [
    //         ['bank' => 'BCA', 'number' => '1234567890', 'name' => 'PT Kost Alifia'],
    //         ['bank' => 'Mandiri', 'number' => '0987654321', 'name' => 'PT Kost Alifia'],
    //     ];

    //     return view('user.bookingconfirmation', compact('booking', 'room', 'bankAccounts'));
    // }


    public function historyBooking()
    {
         $bookings = KelolaPemesanan::with('kamar')
        ->where('penghuni_id', auth()->id()) // ✅ gunakan nama kolom yang benar
        ->get();

    return view('user.bookinghistory', compact('bookings'));
    }



    public function showForgetPasswordForm()
    {
        return view('auth.user.forgetpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.user.resetpassword')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        // Proses reset password
        $status = \Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($status === \Password::PASSWORD_RESET) {
            return redirect()->route('auth.user.login')
                ->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
        }
        return back()->withErrors(['email' => __($status)]);
    }


    public function showhistory()
    {
        $userId = Auth::id(); // Ambil ID user login

        // Ambil semua booking user yang login
        $bookings = KelolaPemesanan::with('kamar')
            ->where('penghuni_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Bisa pakai get() kalau mau tanpa pagination

        // Kirim data ke view
        return view('user.history-booking', compact('bookings'));
    }


    public function showdetail($id)
    {
        $booking = KelolaPemesanan::with(['kamar', 'penghuni'])->findOrFail($id);

        return response()->json($booking);
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }


}
