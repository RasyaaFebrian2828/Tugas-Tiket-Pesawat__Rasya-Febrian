<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\KelasPenerbangan;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index(){
        $data = Auth::user()->pemesanans()->with('penerbangan','kelas','pembayaran')->get();
        return view('user.pemesanan.index', compact('data'));
    }

    public function create($kelas_id){
        $kelas = KelasPenerbangan::with('penerbangan')->findOrFail($kelas_id);
        return view('user.pemesanan.create', compact('kelas'));
    }

    public function store(Request $r){
        $r->validate(['kelas_id'=>'required|exists:kelas_penerbangans,id','jumlah_tiket'=>'required|integer|min:1']);
        $kelas = KelasPenerbangan::findOrFail($r->kelas_id);
        if ($kelas->sisa_kursi < $r->jumlah_tiket) return back()->with('error','Kursi tidak cukup');
        $total = $kelas->harga * $r->jumlah_tiket;
        $p = Pemesanan::create(['user_id'=>Auth::id(),'penerbangan_id'=>$kelas->penerbangan_id,'kelas_id'=>$kelas->id,'jumlah_tiket'=>$r->jumlah_tiket,'total_harga'=>$total,'status'=>'Menunggu Pembayaran']);
        $kelas->decrement('sisa_kursi',$r->jumlah_tiket);
        return redirect()->route('pembayaran.create',$p->id)->with('success','Pemesanan dibuat, silakan bayar');
    }
}
