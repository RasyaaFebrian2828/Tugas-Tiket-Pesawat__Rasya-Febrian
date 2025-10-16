<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('penerbangan_id')->constrained('penerbangans')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas_penerbangans')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('status',['Menunggu Pembayaran','Dibayar','Selesai','Dibatalkan'])->default('Menunggu Pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
