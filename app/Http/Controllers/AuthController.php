<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🏠 Halaman login awal
    public function index()
    {
        return view('admin.auth');
    }

    // 🔐 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
        ]);

        // 👉 Contoh login sederhana (belum pakai DB)
        // Ganti dengan Auth::attempt() jika pakai tabel users
        if ($request->username === $request->password) {
            // ✅ Jika username dan password sama, tampilkan tampilan sukses
            return view('admin.auth', ['success' => true, 'username' => $request->username]);
        }

        // ❌ Jika salah, kembali dengan pesan error
        return back()->withErrors([
            'login' => 'Username dan password tidak cocok!',
        ])->withInput();
    }
}
