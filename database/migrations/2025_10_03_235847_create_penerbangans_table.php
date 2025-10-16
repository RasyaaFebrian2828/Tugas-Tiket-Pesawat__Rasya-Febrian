<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerbangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penerbangan')->unique();
            $table->string('maskapai')->default('Lion Air');
            $table->string('asal');
            $table->string('tujuan');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('waktu_tiba');
            $table->integer('durasi_menit')->nullable();
            $table->integer('harga')->default(0);
            $table->integer('kursi_tersedia')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerbangans');
    }
};
