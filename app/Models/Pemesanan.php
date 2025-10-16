<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    protected $fillable = [
        'user_id','penerbangan_id','kelas_id','jumlah_tiket','total_harga','status'
    ];

    public function user(){ return $this->belongsTo(User::class,'user_id'); }
    public function penerbangan(){ return $this->belongsTo(Penerbangan::class,'penerbangan_id'); }
    public function kelas(){ return $this->belongsTo(KelasPenerbangan::class,'kelas_id'); }
    public function pembayaran(){ return $this->hasOne(Pembayaran::class,'pemesanan_id'); }
}
