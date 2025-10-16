<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penerbangan;

class UserController extends Controller
{
    // Halaman dashboard user (setelah login)
    public function dashboard()
    {
        // Ambil semua penerbangan beserta relasi kelas (kalau ada)
        $penerbangan = Penerbangan::with('kelas')->get();

        // Kirim data ke view
        return view('user.dashboard', compact('penerbangan'));
    }

    // Halaman publik (sebelum login)
    public function daftarPenerbangan()
    {
        $penerbangan = Penerbangan::with('kelas')->get();

        // Kalau user sudah login, arahkan ke dashboard user
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        // Kalau belum login, tampilkan halaman publik
        return view('user.dashboard', compact('penerbangan'));
    }
}
