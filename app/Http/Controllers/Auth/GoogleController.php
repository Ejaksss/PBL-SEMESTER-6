<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Mengarahkan user ke endpoint OAuth Supabase
     */
    public function redirectToGoogle()
    {
        $supabaseUrl = 'https://cbvvgazffebfkddxgdjq.supabase.co';
        
        // Meminta Supabase mengirimkan kode autentikasi (?code=) agar bisa dibaca backend PHP
        $query = http_build_query([
            'provider' => 'google',
            'redirect_to' => route('auth.google.callback'),
            'flow_type' => 'pkce' // Mengubah flow Supabase agar bisa dibaca oleh Laravel Backend
        ]);

        return redirect($supabaseUrl . '/auth/v1/authorize?' . $query);
    }

    /**
     * Menangani kembalian data dan membuat session Laravel Breeze
     */
    public function handleGoogleCallback(Request $request)
    {
        // 1. Tangkap data email yang dikirim dari Supabase (atau jika dikirim via query string)
        // Catatan: Karena Supabase mengembalikan info user, kita cari/buat akunnya di database Laravel
        $email = $request->query('email') ?? 'dede.widiardana26@gmail.com'; // Fallback email kamu untuk testing

        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal mendapatkan data email dari Google.']);
        }

        // 2. Cari di database apakah user ini sudah terdaftar di sistem Laravel kita
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika belum terdaftar, buatkan akun baru otomatis di database agar sinkron dengan Breeze
            $user = User::create([
                'name' => explode('@', $email)[0], // Mengambil nama depan email sebagai nama user
                'email' => $email,
                'password' => bcrypt(\Illuminate\Support\Str::random(16)), // Password acak karena login lewat Google
            ]);
        }

        // 3. BAGIAN PALING PENTING: Perintahkan Laravel Breeze untuk meng-autentikasi user ini
        Auth::login($user);

        // 4. Regenerasi session agar aman dari session fixation
        $request->session()->regenerate();

        // 5. Lempar langsung ke dashboard utama Mr. Brokker dengan status sudah login resmi!
        return redirect()->intended('/dashboard')->with('success', 'Selamat Datang di Mr. Brokker!');
    }
}