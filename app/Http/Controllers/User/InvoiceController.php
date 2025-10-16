<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class InvoiceController extends Controller
{
    public function show($pemesanan_id)
    {
        $pemesanan = Pemesanan::with('penerbangan', 'kelas', 'pembayaran')
                        ->findOrFail($pemesanan_id);

        // Cek status pembayaran
        if (!$pemesanan->pembayaran || !in_array($pemesanan->pembayaran->status, ['Diterima'])) {
            return redirect()->back()->with('error', 'Invoice hanya tersedia untuk pembayaran yang sudah diterima.');
        }

        return view('user.invoice.show', compact('pemesanan'));
    }
}
