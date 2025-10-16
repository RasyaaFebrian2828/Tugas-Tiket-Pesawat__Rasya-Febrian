<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penerbangan;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class AdminController extends Controller
{
    public function dashboard(){
        $totalUser = User::count();
        $totalPenerbangan = Penerbangan::count();
        $totalPemesanan = Pemesanan::count();
        $pembayaranMenunggu = Pembayaran::where('status','Menunggu Verifikasi')->count();
        $users = User::all();
        return view('admin.dashboard', compact('totalUser','totalPenerbangan','totalPemesanan','pembayaranMenunggu','users'));
    }
}
