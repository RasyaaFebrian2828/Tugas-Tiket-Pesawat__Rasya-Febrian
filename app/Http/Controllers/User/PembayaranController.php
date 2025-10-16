<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    // Menampilkan form pembayaran
    public function create($pemesanan_id)
    {
        $pemesanan = Pemesanan::with('penerbangan','kelas','pembayaran')
            ->findOrFail($pemesanan_id);

        // Cek jika sudah ada pembayaran
        if($pemesanan->pembayaran) {
            return redirect()->route('user.dashboard')->with('info', 'Pembayaran sudah dilakukan.');
        }

        return view('user.pembayaran.create', compact('pemesanan'));
    }

    // Simpan bukti pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:4096'
        ]);

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

        // Cek jika sudah ada pembayaran
        if($pemesanan->pembayaran) {
            return redirect()->route('user.dashboard')->with('info', 'Pembayaran sudah dilakukan.');
        }

        // Upload bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Simpan ke database
        Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran terkirim, tunggu verifikasi admin.');
    }
}
