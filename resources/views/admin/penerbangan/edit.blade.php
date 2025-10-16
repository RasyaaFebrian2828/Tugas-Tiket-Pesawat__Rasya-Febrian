<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penerbangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl mb-4">Edit Penerbangan</h1>
    <form action="{{ route('admin.penerbangan.update', $penerbangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Kode Penerbangan</label>
        <input type="text" name="kode_penerbangan" value="{{ $penerbangan->kode_penerbangan }}" class="w-full border p-2 mb-2" required>
        <label>Maskapai</label>
        <input type="text" name="maskapai" value="{{ $penerbangan->maskapai }}" class="w-full border p-2 mb-2" required>
        <label>Asal</label>
        <input type="text" name="asal" value="{{ $penerbangan->asal }}" class="w-full border p-2 mb-2" required>
        <label>Tujuan</label>
        <input type="text" name="tujuan" value="{{ $penerbangan->tujuan }}" class="w-full border p-2 mb-2" required>
        <label>Waktu Berangkat</label>
        <input type="datetime-local" name="waktu_berangkat" value="{{ \Carbon\Carbon::parse($penerbangan->waktu_berangkat)->format('Y-m-d\TH:i') }}" class="w-full border p-2 mb-2" required>
        <label>Waktu Tiba</label>
        <input type="datetime-local" name="waktu_tiba" value="{{ \Carbon\Carbon::parse($penerbangan->waktu_tiba)->format('Y-m-d\TH:i') }}" class="w-full border p-2 mb-2" required>
        <label>Harga</label>
        <input type="number" name="harga" value="{{ $penerbangan->harga }}" class="w-full border p-2 mb-2" required>
        <label>Kursi Tersedia</label>
        <input type="number" name="kursi_tersedia" value="{{ $penerbangan->kursi_tersedia }}" class="w-full border p-2 mb-2" required>
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Update</button>
    </form>
</div>
</body>
</html>
