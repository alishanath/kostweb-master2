<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }



    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->role !== 'admin') {
            Auth::logout();
            return back()->withErrors([
                'username' => 'Akun ini tidak memiliki akses admin.',
            ]);
            }

            return redirect()->route('dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);

    }



    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus seluruh sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }


}
