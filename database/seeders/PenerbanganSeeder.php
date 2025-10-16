<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penerbangan;
use App\Models\KelasPenerbangan;
use Carbon\Carbon;

class PenerbanganSeeder extends Seeder {
    public function run(): void {
        $p = Penerbangan::create([
            'kode_penerbangan'=>'JT-123',
            'maskapai'=>'Lion Air',
            'asal'=>'Jakarta (CGK)',
            'tujuan'=>'Bali (DPS)',
            'waktu_berangkat'=>Carbon::parse('2025-10-10 08:00:00'),
            'waktu_tiba'=>Carbon::parse('2025-10-10 10:30:00'),
            'durasi_menit'=>150,
            'harga'=>700000,
            'kursi_tersedia'=>160
        ]);

        KelasPenerbangan::create(['penerbangan_id'=>$p->id,'nama_kelas'=>'Ekonomi','harga'=>700000,'jumlah_kursi'=>120,'sisa_kursi'=>120]);
        KelasPenerbangan::create(['penerbangan_id'=>$p->id,'nama_kelas'=>'Bisnis','harga'=>1500000,'jumlah_kursi'=>30,'sisa_kursi'=>30]);
        KelasPenerbangan::create(['penerbangan_id'=>$p->id,'nama_kelas'=>'First Class','harga'=>3000000,'jumlah_kursi'=>10,'sisa_kursi'=>10]);
    }
}
