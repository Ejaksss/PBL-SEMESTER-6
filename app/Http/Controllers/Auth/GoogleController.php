<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Mengarahkan user ke endpoint OAuth Supabase dengan PKCE
     */
    public function redirectToGoogle()
    {
        // 1. Generate code_verifier (harus disimpan untuk dipakai lagi saat callback)
        $codeVerifier = Str::random(64);
        session(['google_code_verifier' => $codeVerifier]);

        // 2. Generate code_challenge (S256 dari code_verifier)
        $codeChallenge = rtrim(strtr(base64_encode(hash('sha256', $codeVerifier, true)), '+/', '-_'), '=');

        $query = http_build_query([
            'provider' => 'google',
            'redirect_to' => route('auth.google.callback'),
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        return redirect(config('services.supabase.url') . '/auth/v1/authorize?' . $query);
    }

    /**
     * Menangani callback dari Supabase, tukar code dengan data user asli
     */
    public function handleGoogleCallback(Request $request)
    {
        // Jika Supabase/Google gagal, dia kirim ?error=...
        if ($request->has('error')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Login Google gagal: ' . $request->query('error_description', $request->query('error')),
            ]);
        }

        $code = $request->query('code');
        $codeVerifier = session('google_code_verifier');
        session()->forget('google_code_verifier');

        if (!$code || !$codeVerifier) {
            return redirect()->route('login')->withErrors(['email' => 'Kode autentikasi tidak ditemukan atau kadaluarsa.']);
        }

        // 1. Tukar authorization code dengan access_token + data user via Supabase
        $response = Http::withHeaders([
            'apikey' => config('services.supabase.anon_key'),
            'Content-Type' => 'application/json',
        ])->post(config('services.supabase.url') . '/auth/v1/token?grant_type=pkce', [
            'auth_code' => $code,
            'code_verifier' => $codeVerifier,
        ]);

        if ($response->failed()) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal memverifikasi login Google. Coba lagi.']);
        }

        $data = $response->json();
        $supabaseUser = $data['user'] ?? null;

        if (!$supabaseUser || empty($supabaseUser['email'])) {
            return redirect()->route('login')->withErrors(['email' => 'Data user tidak diterima dari Supabase.']);
        }

        $email = $supabaseUser['email'];
        $name = $supabaseUser['user_metadata']['full_name']
            ?? $supabaseUser['user_metadata']['name']
            ?? explode('@', $email)[0];
        $avatar = $supabaseUser['user_metadata']['avatar_url'] ?? null;

        // 2. Cari atau buat user di database Laravel
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => bcrypt(Str::random(24)),
                'email_verified_at' => now(), // sudah diverifikasi oleh Google
            ]
        );

        // Opsional: update nama/avatar tiap kali login, kalau ada kolom avatar
        // $user->update(['name' => $name, 'avatar' => $avatar]);

        // 3. Login user via Laravel Breeze
        Auth::login($user, remember: true);

        // 4. Regenerasi session agar aman dari session fixation
        $request->session()->regenerate();

        // 5. Redirect ke dashboard
        return redirect()->intended('/dashboard')->with('success', 'Selamat Datang di Mr. Brokker, ' . $user->name . '!');
    }
}