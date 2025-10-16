<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penerbangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl mb-4">Tambah Penerbangan</h1>
    <form action="{{ route('admin.penerbangan.store') }}" method="POST">
        @csrf
        <label>Kode Penerbangan</label>
        <input type="text" name="kode_penerbangan" class="w-full border p-2 mb-2" required>
        <label>Maskapai</label>
        <input type="text" name="maskapai" class="w-full border p-2 mb-2" required>
        <label>Asal</label>
        <input type="text" name="asal" class="w-full border p-2 mb-2" required>
        <label>Tujuan</label>
        <input type="text" name="tujuan" class="w-full border p-2 mb-2" required>
        <label>Waktu Berangkat</label>
        <input type="datetime-local" name="waktu_berangkat" class="w-full border p-2 mb-2" required>
        <label>Waktu Tiba</label>
        <input type="datetime-local" name="waktu_tiba" class="w-full border p-2 mb-2" required>
        <label>Kursi Tersedia</label>
        <input type="number" name="kursi_tersedia" class="w-full border p-2 mb-2" required>

        <h2 class="mt-4 font-bold">Kelas Penerbangan</h2>
        @php
            $kelasList = ['Ekonomi','Bisnis','First Class'];
        @endphp
        @foreach($kelasList as $kelas)
        <div class="border p-2 mb-2 rounded">
            <label>Nama Kelas</label>
            <input type="text" value="{{ $kelas }}" name="kelas[{{ $loop->index }}][nama_kelas]" readonly class="w-full border p-1 mb-1">
            <label>Harga</label>
            <input type="number" name="kelas[{{ $loop->index }}][harga]" class="w-full border p-1 mb-1" required>
            <label>Jumlah Kursi</label>
            <input type="number" name="kelas[{{ $loop->index }}][jumlah_kursi]" class="w-full border p-1 mb-1" required>
        </div>
        @endforeach

        <button class="bg-green-600 text-white px-3 py-1 rounded mt-2">Simpan</button>
    </form>
</div>
</body>
</html>
