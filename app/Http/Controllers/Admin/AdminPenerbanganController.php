<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penerbangan;

class AdminPenerbanganController extends Controller
{
    public function index() {
        $penerbangans = Penerbangan::with('kelas')->get();
        return view('admin.penerbangan.index', compact('penerbangans'));
    }

    public function create() {
        return view('admin.penerbangan.create');
    }

    public function store(Request $r) {
        $r->validate([
            'kode_penerbangan'=>'required|unique:penerbangans',
            'maskapai'=>'required',
            'asal'=>'required',
            'tujuan'=>'required',
            'waktu_berangkat'=>'required|date',
            'waktu_tiba'=>'required|date|after:waktu_berangkat',
            'kursi_tersedia'=>'required|integer|min:1',
            'kelas'=>'required|array'
        ]);

        $p = Penerbangan::create([
            'kode_penerbangan'=>$r->kode_penerbangan,
            'maskapai'=>$r->maskapai,
            'asal'=>$r->asal,
            'tujuan'=>$r->tujuan,
            'waktu_berangkat'=>$r->waktu_berangkat,
            'waktu_tiba'=>$r->waktu_tiba,
            'kursi_tersedia'=>$r->kursi_tersedia
        ]);

        foreach($r->kelas as $kelas){
            $p->kelas()->create([
                'nama_kelas'=>$kelas['nama_kelas'],
                'harga'=>$kelas['harga'],
                'jumlah_kursi'=>$kelas['jumlah_kursi'],
                'sisa_kursi'=>$kelas['jumlah_kursi']
            ]);
        }

        return redirect()->route('admin.penerbangan.index')->with('success','Penerbangan berhasil dibuat');
    }

    public function edit(Penerbangan $penerbangan) {
        return view('admin.penerbangan.edit', compact('penerbangan'));
    }

    public function update(Request $r, Penerbangan $penerbangan) {
        $r->validate([
            'kode_penerbangan'=>'required|unique:penerbangans,kode_penerbangan,'.$penerbangan->id,
            'maskapai'=>'required',
            'asal'=>'required',
            'tujuan'=>'required',
            'waktu_berangkat'=>'required|date',
            'waktu_tiba'=>'required|date|after:waktu_berangkat',
            'kursi_tersedia'=>'required|integer|min:1',
        ]);

        $penerbangan->update($r->only([
            'kode_penerbangan','maskapai','asal','tujuan','waktu_berangkat','waktu_tiba','kursi_tersedia'
        ]));

        return redirect()->route('admin.penerbangan.index')->with('success','Penerbangan berhasil diupdate');
    }

    public function destroy(Penerbangan $penerbangan) {
        $penerbangan->delete();
        return redirect()->route('admin.penerbangan.index')->with('success','Penerbangan berhasil dihapus');
    }
}
