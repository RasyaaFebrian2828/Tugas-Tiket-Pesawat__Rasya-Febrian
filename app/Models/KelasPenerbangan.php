<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPenerbangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerbangan_id',
        'nama_kelas',
        'harga',
        'jumlah_kursi',
        'sisa_kursi'
    ];

    public function penerbangan()
    {
        return $this->belongsTo(Penerbangan::class);
    }
}
