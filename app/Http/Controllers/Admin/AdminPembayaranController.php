<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class AdminPembayaranController extends Controller
{
    public function index(){
        $list = Pembayaran::with('pemesanan.user','pemesanan.kelas','pemesanan.penerbangan')->latest()->get();
        return view('admin.pembayaran.index', compact('list'));
    }

    public function updateStatus(Request $r, $id){
        $r->validate(['status'=>'required|in:Menunggu Verifikasi,Diterima,Ditolak']);
        $p = Pembayaran::findOrFail($id);
        $p->update(['status'=>$r->status]);
        if ($r->status === 'Diterima') {
            $p->pemesanan->update(['status'=>'Dibayar']);
        }
        return back()->with('success','Status diperbarui');
    }
}
