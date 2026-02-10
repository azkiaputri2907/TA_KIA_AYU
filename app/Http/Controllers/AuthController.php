<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan Halaman Login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Login (YANG DIPERBARUI)
    public function login(Request $request) {
        
        // 1. Validasi Input (Tambahkan validasi untuk 'role')
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,ketua', // Pastikan input role ada dan valid
        ]);

        // Kita pisahkan credentials login (email & pass) dari role
        $loginDetails = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // 2. Coba Login dengan Email & Password
        if (Auth::attempt($loginDetails)) {
            
            $request->session()->regenerate();
            $user = Auth::user();

            // ============================================================
            // 3. LOGIKA PENGECEKAN KETAT (STRICT CHECK)
            // ============================================================
            
            // Cek apakah Role di Database SAMA dengan Role yang dipilih di Form
            if ($user->role !== $request->role) {
                
                // Jika password benar TAPI salah pilih role (Radio Button):
                // Logout paksa user tersebut
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Kembalikan ke halaman login dengan pesan error spesifik
                return back()->withErrors([
                    'role' => 'Login Gagal! Akun Anda terdaftar sebagai ' . strtoupper($user->role) . 
                              ', bukan ' . strtoupper($request->role) . '.'
                ])->withInput();
            }

            // 4. Jika Role Cocok, Lanjutkan Redirect
            if($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('ketua.dashboardkajur');
        }

        // 5. Jika Email atau Password Salah
        return back()->withErrors([
            'email' => 'Email atau Password salah!'
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Pastikan route ini bernama 'login'
    }
}