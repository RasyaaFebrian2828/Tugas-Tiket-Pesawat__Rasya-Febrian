<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbangan extends Model
{
    use HasFactory;

    protected $table = 'penerbangans';

    protected $fillable = [
        'kode_penerbangan','maskapai','asal','tujuan',
        'waktu_berangkat','waktu_tiba','durasi_menit','harga','kursi_tersedia'
    ];

    public function kelas()
    {
        return $this->hasMany(KelasPenerbangan::class,'penerbangan_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class,'penerbangan_id');
    }
}
